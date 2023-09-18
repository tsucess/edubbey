<?php
$title = "Support";
$page = "support";

require './template/header-links.php';
require './template/header.php';

$category_query = "SELECT * FROM category";
$categories = mysqli_query($dbconnect, $category_query);

$categoryNo = 0;



$query = "SELECT * FROM txn_details WHERE users_id = $current_user_id AND payment_status = 'pending'";
$result = mysqli_query($dbconnect, $query);

if (mysqli_num_rows($result) > 0) {

  // delete Registratration from database
  $delete_txn_query = "DELETE FROM txn_details WHERE users_id = $current_user_id AND payment_status = 'pending'";
  $delete_txn_result = mysqli_query($dbconnect, $delete_txn_query);
}

?>


<div class="container-fluid">
  <div class="row">
          <!-- sidebar  -->
  <?php require './template/sidebar.php'; ?>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">     
            
            <div class="container">
                <div class="row text-center">
                    <h2 class="display-5">How can we help you?</h2>
                </div>
                <div class="row my-2">
                    
                </div>
                <div class="row gradient p-2 my-4">
                    <h2 class="text-capitalize text-white text-center my-4">Frequently asked questions</h2>
                    <div class="col-md-8 mx-auto">
                        <div class="accordion" id="accordionExample">
                            <!-- Accordion item 1 -->

                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How do I Subscribe?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Navigate to the subscription page by clicking on the subscribe option on the sidebar on your left,
                                        select your preferred categories you want to subscribe for submit to proceed to summary of your choices, review 
                                        your choice of accuracy and click on proceed to payment button to make payments
                                    </div>
                                </div>
                            </div>
                            <!-- Accordion item 2 -->

                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How do I print invoice for my subscription
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Click on your dashboard below your profile is a table that display a brief detail of your subcription, on the invoice column
                                        there is a button to view your invoice, click to view invoice then below the details of your invoice is a button to print your invoice in pdf format
                                    </div>
                                </div>
                            </div>
                            <!-- Accordion item 3 -->

                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        May I have access to the interactive contents before subscription?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Yes, you can email us at info@edubbey.com to request for demo. We have a demo website consists of our FREE access interactive contents.
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row text-white my-4">
                    <div class="col-8 b-white shadow p-3 mx-auto">
                        <div class="form w-100 pb-2">
                            <h4 class="display-3--title mb-5">Let's Talk</h4>
                          
                            <?php if(isset($_SESSION['notify'])): ?>
                                <div class="error-text-valid mb-3 text-center">
                                        <?php $_SESSION['notify'];
                                            unset($_SESSION['notify']);
                                            ?>
                                    </div>
                
                            <?php endif ?>

                            <form action="../../assets/php/mail.php" method="POST" class="row">
                                <div class="col-lg-6  col-md-6 mb-3">
                                    <input type="text" placeholder="First Name" id="InputFirstName" name="fname"
                                        class="shadow form-control form-control-lg">
                                </div>
                                <div class="col-lg-6 col-md-6 mb-3">
                                    <input type="text" placeholder="Last Name" id="InputLastName" name="lname"
                                        class="shadow form-control form-control-lg">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <input type="email" placeholder="Email Address" id="InputEmail" name="email"
                                        class="shadow form-control form-control-lg">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <textarea name="message" placeholder="Message" id="message"
                                        class="shadow form-control form-control-lg" rows="8"></textarea>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="g-recaptcha" data-sitekey="6LdDaoMkAAAAANjAYVzDQ6dkTzZ82O76se-wA8z5"></div>
                                </div>
                                <div class="text-center d-grid mt-1">
                                    <button type="submit" name="submit" class="btn btn-primary rounded-pill pt-3 pb-3 mx-auto btn_send">
                                        Submit <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row text-white">
                    <div class="col-12 col-lg-6 gradient shadow p-3">
                        <div class="cta-info w-100">
                            <h4 class="display-4">We are here!</h4>
                            <p class="lh-lg">We are delighted to here from you, and we will be glad to help and support you...</h3>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 gradient shadow p-3">
                        <div class="cta-info w-100">
                            <h4 class="lh-lg">Make Enquiries:</h4>
                            <ul class="cta-info__list">
                                <li><i class="fa fa-phone"></i> &nbsp; +234 706 912 8649</li>
                                <li><i class="fa fa-whatsapp"></i> &nbsp; +234 702 044 2883</li>
                                <li><i class="fa fa-envelope"></i> &nbsp; info@edubbey.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          </main>  
    </div>
  </div>


  <script>
    let checkboxes = document.querySelectorAll(".checkboxes");

    function checkAll(markAll) {
        if (markAll.checked == true) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }
</script>

    <?php require './template/footer.php'; ?>