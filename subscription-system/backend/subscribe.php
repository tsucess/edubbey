<?php
$title = "Subscribe";
$page = "subscribe";

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
              <?php if(isset($_SESSION['valid'])): ?>
                  <div class="form-floating">
                      <div class="error-text-valid">
                                <?php $_SESSION['valid'];
                  unset($_SESSION['valid']);
                  ?></div>
                      </div>
              <?php endif ?>
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1 mb-3 border-bottom">
                <h2>Subcribe</h2>
              </div>
              <form action="<?= ROOT_URL ?>backend/summary.php" id="reg_form" method="POST">
                    <div class="table-responsive custom-table-responsive">
                      <table class="table custom-table">
                        <thead>
                          <tr>
                            <th scope="col">Serial-No.</th>
                            <th scope="col">Category</th>
                            <th scope="col">Fee</th>   
                            <th scope="col">
                              <label class="control control--checkbox">
                                <input type="checkbox" onchange="checkAll(this)" class="checkboxes" id="markall" /> 
                                <div class="control__indicator"></div>
                              </label>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                              <?php if (mysqli_num_rows($categories) > 0) : ?>
                                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                                  <tr>
                                    <td> &nbsp; <?= ++$categoryNo ?></td>    
                                    <td> 
                                      <?php echo $category['category_title'];?>
                                          <br>
                                          <b>Available Courses:</b>                                         
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
                                    <th scope="row">                      
                                      <label class="control control--checkbox">
                                        <input type="checkbox" name="selected_courses[]" value="<?= $category['id'] ?>" class="checkboxes" /> 
                                        <div class="control__indicator"></div>
                                      </label>
                                    </th> 
                                    </tr>
                                <tr class="spacer">
                                  <td colspan="4"></td>
                                </tr>
                                <?php endwhile ?>
                                <tr class="spacer">
                                  <td colspan="3" class="text-center p-2"></td>
                                  <td colspan="" class="p-2">
                                    <input type="submit" class="btn btn-primary px-4 rounded-pill" name="submit" value="Submit">
                                  </td>
                                </tr>
                              <?php else :  ?>
                                  <tr>
                                      <td colspan="3" class="text-center p-2"> No Category Created</td>
                                  </tr>
                              <?php endif  ?>
                        </tbody>
                      </table>
                  </div>
              </form>
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