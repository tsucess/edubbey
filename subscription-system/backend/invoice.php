<?php
require './config/database.php';

$current_user_id = $_SESSION['user_id'];


if (isset($_SESSION['user_id'])) {
  $curUserId = $_SESSION['user_id'];

  $query = "SELECT * FROM users WHERE id = $curUserId";
  $curUsers = mysqli_query($dbconnect, $query);

  if(mysqli_num_rows($curUsers) > 0) {
      $curUser = mysqli_fetch_assoc($curUsers);
  }
}

if (isset($_GET['id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM transactions WHERE id = $id";
$sub_histroy = mysqli_query($dbconnect, $query);
}
?>


<style>
  @media print {
    body *:not(main):not(main *) {
        visibility: hidden;
    }

    main {
        visibility: visible;
    }

    button, a.btn {
        visibility: hidden;
    }

}
</style>

  <!-- Bootstrap -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link href="../css/custom.css" rel="stylesheet">

  <div class="container-fluid">
    <div class="row">
                <main class="col-md-8 ms-sm-auto col-lg-8 mx-auto">
                    <?php if(isset($_SESSION['valid'])): ?>
                        <div class="form-floating">
                            <div class="error-text-valid">
                                      <?php $_SESSION['valid'];
                        unset($_SESSION['valid']);
                        ?></div>
                            </div>
                    <?php endif ?>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-1 border-bottom">
                      <h1>INVOICE</h1>  
                      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
                        <img class="brand" src="../../img/brand/xsm-logo.png" alt="Edubbey">
                      </a>
                    </div>
                      <div class="container ">
                          <div class="row">
                              <div class="col-md-12">
                                  <h2 class="text-center">User's profile</h2>
                              </div>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-md">
                                  <tbody>
                                        <tr>
                                            <td>
                                              <div class="avatar-display-2 mx-auto">
                                                <img class="image-banner" src="<?= ROOT_URL . 'img/users-img/'.$curUser['avatar'] ?>" alt="Avatar">
                                              </div>
                                            </td>    
                                            <td>
                                              <table class="table display-profile table-striped table-sm mt-4">
                                                  <tbody>
                                                      <tr>
                                                          <th>Name:</th>
                                                          <td><?= "{$curUser['firstname']} {$curUser['lastname']}"  ?></td>
                                                      </tr>
                                                      <tr>
                                                          <th>Email:</th>
                                                          <td><?= $curUser['email'] ?></td>
                                                      </tr>
                                                      <?php
                                                      $email = $curUser['email'];
                                                      // check if the email already exist
                                                      $uquery = "SELECT email FROM users  WHERE email = '$email'";
                                                      $sql = mysqli_query($dbconnect, $uquery);

                                                      if(mysqli_num_rows($sql) > 0) { ?>

                                                      <tr>
                                                          <th>School:</th>
                                                          <td><?= $curUser['school'] ?></td>
                                                      </tr>
                                                      <tr>
                                                          <th>Country</th>
                                                          <td><?= strtoupper($curUser['country']) ?></td>
                                                      </tr>

                                                      <?php } ?>
                                                  </tbody>
                                              </table>
                                            </td>    
                                        </tr>
                                  </tbody>
                            </table>
                          </div>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-striped table-md">
                              <thead>
                                    <th colspan="2" class="text-center"> <h2>Subscription Details</h2> </th>
                              </thead>
                              <tbody>
                                <?php if(mysqli_num_rows($sub_histroy) > 0)
                                {

                                  while( $history = mysqli_fetch_assoc($sub_histroy)) {

                                    $today=date('Y-m-d H:i:s');
                                    $expire = $history['expire_date'];

                                    if ($today > $expire){
                                      $status_update = "UPDATE transactions SET status = 0";
                                      $status_result = mysqli_query($dbconnect, $status_update);
                                    }

                                  
                                  ?>
                                      <tr>
                                            <th scope="col">Date</th>
                                            <td><b><?= $history['created'] ?></b></td>    
                                      </tr>
                                     
                                      <tr>
                                          <th scope="col">Expiry Date</th>
                                          <td><?= $history['expire_date'] ?></td>               
                                      </tr>
                                      <tr>
                                      <th scope="col">Amount</th>
                                          <td><b>$ <?= $history['paid_amount'] ?></b> </td>          
                                      </tr>
                                      <tr>          
                                              <th scope="col">Status</th>            
                                              <?php if($history['status'] == 1): ?>     
                                              <td style="color: green">Active</td>   
                                              <?php else: ?>     
                                                <td style="color: red">Expired</td>   
                                              <?php endif ?> 
                                      </tr>
                                      <?php 
                                          $category_titles = $history['courses_title'];
                                          $category_id = $history['courses_id'];

                                          $cate_titles = explode(',', $category_titles);
                                          $cate_id =  explode(',', $category_id);

                                        foreach ($cate_id as $item_title) {
                                                  $cate_query = "SELECT * FROM category WHERE id = $item_title";
                                                  $category_result = mysqli_query($dbconnect, $cate_query);

                                              while ($category = mysqli_fetch_assoc($category_result)) {
                                                  ?>
                                            <tr>
                                              <th scope="col">Level</th> 
                                              <td style="text-transform: uppercase;"> <b><?php echo $category['category_title']; ?> </b></td>
                                            </tr>
                                          
                                          <?php
                                            
                                                $query = "SELECT * FROM course WHERE category_id = $item_title";
                                                $course_result = mysqli_query($dbconnect, $query);

                                                while ($course = mysqli_fetch_assoc($course_result)) {
                                                    ?>
                                                  <tr>
                                                    <td></td> 
                                                    <td style="text-transform: capitalize"> <b>-</b> &nbsp;<em> <?php echo $course['course_title']; ?></em></td> 
                                                  </tr>
                                                <?php }
                                                }
                                            }
                                      ?>
                              <?php } 
                                  }?>
                              </tbody>
                          </table>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-md">
                              
                              <tbody>
                                      <tr>
                                          <td><a href="index.php" class="btn btn-warning px-5 rounded-pill">Back</a></td>
                                          <td><button class="btn btn-primary rounded-pill" onclick="window.print()">Print Invoice</button></td>   
                                      </tr>
                              </tbody>
                          </table>
                      </div>
              </main>
            </div>
          </div>
        <?php require './template/footer.php'; ?>