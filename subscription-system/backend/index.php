<?php
  $title = "Dashboard";
  $page = "home";
  $url = "index";

  require './template/header-links.php';
  require './template/header.php';


if(mysqli_num_rows($curAdmins) > 0) {
  $admin_query = "SELECT * FROM transactions";
$sub_histroy = mysqli_query($dbconnect, $admin_query);
} 
else
{
  $query = "SELECT * FROM transactions WHERE user_id = $current_user_id";
  $sub_histroy = mysqli_query($dbconnect, $query);
}

?>
  <div class="container-fluid">
    <div class="row animate__slideInRight">
            <!-- sidebar  -->
    <?php require './template/sidebar.php'; ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 animate__zoomIn">
              <?php if(isset($_SESSION['valid'])): ?>
                  <div class="form-floating">
                      <div class="error-text-valid">
                                <?php $_SESSION['valid'];
                  unset($_SESSION['valid']);
                  ?></div>
                      </div>
              <?php endif ?>
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1 mb-3 border-bottom">
                <h2>Dashboard</h2>
              </div>
              <div class="container ">
                  <div class="row mt-5 mb-3">
                      <div class="col-md-12">
                          <h4 class="display-6 fw-bold text-center">Profile</h4>
                      </div>
                  </div>
                  <div class="row justify-content-center pb-4 mx-auto">
                      <div class="col-10 col-md-6 col-lg-4 p-4 align-self-center">
                          <div class="avatar-display">
                            <?php if(mysqli_num_rows($curAdmins) > 0): ?>
                              <img class="image-banner" src="<?= ROOT_URL . 'img/admin-img/'.$curUser['avatar'] ?>" alt="Avatar">
                            <?php else:?>
                              <img class="image-banner" src="<?= ROOT_URL . 'img/users-img/'.$curUser['avatar'] ?>" alt="Avatar">
                            <?php endif ?>
                          </div> 
                      </div> 
                      <div class="col-12 col-md-12 col-lg-6 align-self-center">
                        <div class="table-responsive custom-table-responsive">
                          <table class="table display-profile table-striped table-md">  
                            <tbody>
                                <tr>
                                    <th scope="row">Name:</th>
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
                        </div>
                      </div>
                  </div>
              </div>
              <div class="table-responsive custom-table-responsive animate__slideInUp">
                  <table class="table custom-table">
                      <thead>
                          <tr>
                              <th scope="col">&nbsp; Date</th>
                              <th scope="col">Courses</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Expiry Date</th>
                              <?php if(mysqli_num_rows($curUsers) > 0): ?>
                              <th scope="col">Invoice</th>
                              <?php endif ?>
                              <th scope="col">Status</th>

                              <?php if(mysqli_num_rows($curAdmins) > 0): ?>
                              <th scope="col">Delete</th>
                              <?php endif ?>
                          </tr>
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
                                    <td>&nbsp; <b><?= $history['created'] ?></b></td>             
                                    <td><?= $history['courses_title'] ?></td>             
                                    <td><b>$ <?= $history['paid_amount'] ?></b> </td>             
                                    <td><?= $history['expire_date'] ?></td>   
                                    <?php if(mysqli_num_rows($curUsers) > 0): ?>
                                    <td><a href="<?= ROOT_URL ?>backend/invoice.php?id=<?= $history['id'] ?>"  class="btn btn-warning rounded-pill">View</a></td>
                                    <?php endif ?>
                                    <?php if($history['status'] == 1): ?>     
                                      <td style="color: green">Active</td>   
                                      <?php else: ?>     
                                        <td style="color: red">Expired</td>   
                                      <?php endif ?>     
                                  <?php if(mysqli_num_rows($curAdmins) > 0): ?>     
                                    <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-transaction.php?id=<?= $history['id'] ?>&page=<?= $url ?>"  class="btn btn-danger rounded-pill">Delete</a></td>
                                  <?php endif ?>
                              </tr>
                              <tr class="spacer">
                                <td colspan="4"></td>
                              </tr>
                      
                      <?php } 
                          } else {  ?>
                          <tr>
                          <?php if(mysqli_num_rows($curAdmins) > 0): ?>
                              <td colspan="7" class="text-center p-2"> No Subcription History</td>
                              <?php else: ?>
                                <td colspan="6" class="text-center p-2"> No Subcription History</td>
                            <?php endif ?>
                          </tr>
                      <?php } ?>
                      </tbody>
                  </table>
              </div>
      </main>
              
            </div>
          </div>
  <?php require './template/footer.php'; ?>