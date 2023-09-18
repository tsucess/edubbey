<?php
$title = "Add-Admin";
$page = "manage-admin";

require './template/header-links.php';
require './template/header.php';

$query = "SELECT * FROM category";
$categories = mysqli_query($dbconnect, $query);

?>

  <div class="container-fluid">
    <div class="row">
      <!-- sidebar  -->
    <?php require './template/sidebar.php'; ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Add Admin</h2> <a href="manage-admin.php" class="btn btn-success px-5">Back</a>
                </div>
      <!-- <section class="form-section text-center"> -->
        <main class="form-signin w-100 m-auto my-2">
            <form class="admin-form">
                <div class="form-floating">
                    <div class="error-txt">This is an error message</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="fname" id="floatingFistName"
                                placeholder="Enter your First Name">
                            <label for="floatingFistName">First Name:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="lname" id="floatingLastName"
                                placeholder="Enter your Last Name">
                            <label for="floatingLastName">Last Name:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="Email">
                            <label for="floatingEmail">email:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar">
                            <label for="avatar">Avatar:</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control"  name="password" id="" placeholder="Password">
                    <label for="floatingPassword">Password:</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="confirmpassword" id="confirmPassword" placeholder="Password">
                    <label for="confirmPassword">Confirm Password:</label>
                </div>

                <button class="w-100 btn btn-lg mb-5 btn-submit add-admin-btn" type="submit">Create account</button>
            </form>
        </main>

        <div class="container">
          <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
              <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <!--<img class="img-logo" src="../img/xsmlogo.png" alt="EDUBBEY">-->
              </a>
              <span class="mb-3 mb-md-0 text-muted">&copy; 2023 EDUBBEY DYNAMIC SOLUTIONS LIMITED</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
              <li class="ms-3"><a class="text-muted" href="https://www.youtube.com/@edubbey"><svg class="bi" width="24" height="24">
                    <use xlink:href="#youtube" />
                  </svg></a></li>
              <li class="ms-3"><a class="text-muted" href="https://www.instagram.com/edubbey/"><svg class="bi" width="24" height="24">
                    <use xlink:href="#instagram" />
                  </svg></a></li>
              <li class="ms-3"><a class="text-muted" href="https://web.facebook.com/profile.php?id=100083296384256"><svg class="bi" width="24" height="24">
                    <use xlink:href="#facebook" />
                  </svg></a></li>
            </ul>
          </footer>
        </div>
      </main>

    </div>
  </div>

  <script src="../js/add-admin.js"></script>

<?php
    require './template/footer.php';

  ?>

