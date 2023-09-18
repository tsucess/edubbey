<?php
$title = "Edit Profile";
$page = "edit-profile";
  require 'template/header.php';

?>

  <div class="container-fluid">
    <div class="row">
            <!-- sidebar  -->
    <?php require './template/sidebar.php'; ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        
      <section class="form-section text-center" style="padding-top: 0;">
        <main class="form-signin w-100 m-auto" >
            <h3 class="h3 my-4 fw-normal">Edit Profile</h3>

            <form class="signup-form" action="../php/edit-profile-logic.php" enctype="multipart/form-data" method="POST" >
              <?php if(isset($_SESSION['invalid_edit'])) :?>
                <div class="form-floating">
                    <div class="error-text"><?php $_SESSION['invalid_edit'];
                                                unset($_SESSION['invalid_edit']);
                                                    ?></div>
                </div>
              <?php endif ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="hidden" name="id" value="<?= $curUser['id'] ?>" class="form-control" id="id" placeholder="Id">
                            <input type="hidden" name="prev_avatar" value="<?= $curUser['avatar'] ?>" class="form-control" id="prev_avatar" placeholder="prev Avatar">
                            <input type="hidden" name="prev_password" value="<?= $curUser['userpassword'] ?>" class="form-control" id="prev_password" placeholder="prev Avatar">
                            
                            <input type="text" name="firstname" value="<?= $curUser['firstname'] ?>" class="form-control" id="firstname" placeholder="Enter your First Name">
                            <label for="firstname">First Name:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="lastname" class="form-control" value="<?= $curUser['lastname'] ?>" id="lastname" placeholder="Enter your Last Name">
                            <label for="lastname">Last Name:</label>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" value="<?= $curUser['email'] ?>" id="useremail" placeholder="Email Address">
                            <label for="useremail">Email Address:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" name="avatar" class="form-control"  id="avatar" placeholder="Avatar">
                            <label for="avatar">Avatar:</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control"  id="password" placeholder="Password">
                    <label for="password">Password:</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="confirmpassword" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                    <label for="confirmPassword">Confirm Password:</label>
                </div>

                <button class="w-100 btn btn-lg btn-submit signup-btn" type="submit">Update Profile</button>
            
            </form>
        </main>
    </section>
        
      </main>
    </div>
  </div>

<?php require './template/footer.php'; ?>