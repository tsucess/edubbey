<?php
$title = "Summary Page";
$page = "subscribe";

require './template/header-links.php';
require './template/header.php';


if (isset($_POST['submit']) && !empty($_POST['selected_courses'])) {

    $categoriess = $_POST['selected_courses'];
    $total = 0.0;

}

$current_user_id = $_SESSION['user_id'];
// fetch Subject Registered from registered and users table 

$fetch_user_query = "SELECT * FROM  users WHERE id = $current_user_id";
$fetch_user_result = mysqli_query($dbconnect, $fetch_user_query);
$user = mysqli_fetch_assoc($fetch_user_result);


$categoryNo = 0;
$subId = rand(1, 10);

?>


<div class="container-fluid">
  <div class="row">
          <!-- sidebar  -->
  <?php require './template/sidebar.php'; ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
              <?php if(isset($_SESSION['valid'])): ?>
                  <div class="form-floating">
                      <div class="error-text-valid">
                                <?php $_SESSION['valid'];
                  unset($_SESSION['valid']);
                  ?></div>
                      </div>
              <?php endif ?>
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1 mb-3 border-bottom">
                <h2 class="display-6 fw-normal text-center">Summary</h2>
              </div>


 <!-- Display errors returned by checkout session -->
        <div id="paymentResponse" class="hidden"></div>
        <!-- <div class="table-responsive">
                    <table class="table table-striped table-sm"> -->
                    <div class="table-responsive custom-table-responsive">
                      <table class="table custom-table">
                        <thead>
                            <tr>
                              <th scope="col">Serial No.</th>
                              <th scope="col">Category</th>
                              <th scope="col">Available Courses</th>
                              <th scope="col">Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php 
                              
          if(!empty($categoriess)) {
              foreach ($categoriess as $item) {
                  // fetch all subjects from databas
                  $cate_query = "SELECT * FROM category WHERE id =$item ORDER BY id ASC";
                  $categories = mysqli_query($dbconnect, $cate_query);

                  if (mysqli_num_rows($categories) > 0) {

                      while ($category = mysqli_fetch_assoc($categories)) {
                          ?>
                            <tr>
                              <td><?= ++$categoryNo; ?></td>
                              <td><?= $category['category_title']?></td>        
                              <td>                                      
                                <?php
                                    $cat_id = $category['id']; 
                                    $query = "SELECT * FROM course WHERE category_id = $cat_id";
                                    $courses = mysqli_query($dbconnect, $query);
                                    $courses_fee = 0.0;
                                    if (mysqli_num_rows($courses) > 0)
                                    { 
                                      while ($course = mysqli_fetch_assoc($courses))
                                      {
                                        $courses_fee = $courses_fee + $course['amount'];
                                        ?>
                                    <span><?php echo $course['course_title']; ?> <b>,&nbsp;</b></span>
                                    
                                <?php } 
                                
                                $update_price_query = "UPDATE category SET amount = '$courses_fee' WHERE id = $cat_id";
                                $update_price_result = mysqli_query($dbconnect, $update_price_query);
                              }?>
                              </td>
                              <td><?php echo $category['amount'] ?></td>
                            </tr> 
                            <tr class="spacer">
                                  <td colspan="100"></td>
                                </tr>   
                            <?php 
                                  $total = $total + $category['amount'];  
                                    }
                                  }  
                                }
                                foreach ($categoriess as $item) {
                                  $category_query = "SELECT * FROM category WHERE id =$item ORDER BY id ASC";
                                  $categories = mysqli_query($dbconnect, $category_query);
                                  $category = mysqli_fetch_assoc($categories);
                      
                                  $category_titles[] =  $category['category_title'];
                                  $category_id[] = $category['id'];
                                } 
                                  $c_titles = implode(',', $category_titles);
                                  $c_id =  implode(',', $category_id);
                                  $payment_status = "pending";

                                  $txn_query = "INSERT INTO txn_details (courses_title, courses_id, users_id, sub_id, amount, payment_status) VALUES ( '$c_titles', '$c_id', '$current_user_id', '$subId', '$total', '$payment_status')";
                                  $txn_result = mysqli_query($dbconnect, $txn_query);

                                  $_SESSION['amount'] = $total;
                                  $_SESSION['process'] = $current_user_id;

                                ?>
                                  <tr>
                                    <td colspan="2" class="text-center"></td>
                                    <td colspan="" class="text-center"> <b>TOTAL</b></td>
                                    <td colspan=""><b> <?= $total ?>.00 </b></td>
                                  </tr>
                                  <tr class="spacer">
                                    <td colspan="100"></td>
                                  </tr>
                                  <tr class="spacer">
                                      <td colspan="2" class="text-center p-2"></td>
                                      <td colspan="2" class="p-2"> 
                                        <a href="subscribe.php" class="btn btn-warning btn btn-primary px-4 mx-4 rounded-pill">Cancel</a>
                                        <button class="btn btn-primary px-4 stripe-button  rounded-pill" id="payButton">
                                            <span id="buttonText">Proceed to Payment</span>
                                        </button>
                                      </td>
                                  </tr>
                    <?php 

                } else {?>
                              <tr class="spacer">
                                  <td colspan="100"></td>
                                </tr>
                <tr>
                    <td colspan="4" class="text-center p-2"> No course selected</td>
                </tr>

                <?php } ?>               
                        </tbody>
                    </table>
                </div>



            </main>
            
          </div>
        </div>

<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Set Stripe publishable key to initialize Stripe.js
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    // Select payment button
    const payBtn = document.querySelector("#payButton");

    // Payment request handler
    payBtn.addEventListener("click", function(evt) {
        setLoading(true);

        createCheckoutSession().then(function(data) {
            if (data.sessionId) {
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function(stripe) {
        return fetch("payment_init.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                createCheckoutSession: 1,
            }),
        }).then(function(result) {
            return result.json();
        });
    };

    // Handle any errors returned from Checkout
    const handleResult = function(result) {
        if (result.error) {
            showMessage(result.error.message);
        }

        setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            payBtn.disabled = true;
            // document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#buttonText").classList.add("hidden");
        } else {
            // Enable the button and hide spinner
            payBtn.disabled = false;
            // document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#buttonText").classList.remove("hidden");
        }
    }

    // Display message
    function showMessage(messageText) {
        const messageContainer = document.querySelector("#paymentResponse");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function() {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 5000);
    }
</script>

<?php require './template/footer.php'; ?>