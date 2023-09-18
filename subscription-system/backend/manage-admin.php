<?php
$title = "Add-Admin";
$page = "manage-admin";

require './template/header-links.php';
require './template/header.php';

$query = "SELECT * FROM admins WHERE NOT id = $current_user_id";
$admins = mysqli_query($dbconnect, $query);

?>

<div class="container-fluid">
  <div class="row">
          <!-- sidebar  -->
  <?php require './template/sidebar.php'; ?>
              <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2>Manage Administrators</h2> <a href="add-admin.php" class="btn btn-success px-4">Add Admin </a>
                    </div>
<!-- Data table  -->
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php if (mysqli_num_rows($admins) > 0) : ?>
                                    <?php while ($admin = mysqli_fetch_assoc($admins)) : ?>
                                      <tr>
                                        <td><?= "{$admin['firstname']} {$admin['lastname']}"  ?></td>             
                                        <td><?= $admin['email'] ?></td>        
                                        <td><button class="btn btn-primary edit-admin-btn" id="<?= $admin['id'] ?>" data-bs-toggle="modal" data-bs-target="#modalSigninEdit">Edit</button></td>
                                        <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-admin.php?id=<?= $admin['id'] ?>"  class="btn btn-danger">Delete</a></td>
                                </tr>
                            <?php endwhile ?>
                            <?php else :  ?>
                                <tr>
                                    <td colspan="4" class="text-center p-2"> No admin Created</td>
                                </tr>
                            <?php endif  ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="container"> -->

              </main>

<!-- Modal section  -->
<div class="modal" tabindex="-1" id="modalSigninEdit">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="edit-admin-modal">
                    <div class="form-floating">
                        <div class="error-txtmodal"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <div class="form-floating">
                                <input type="hidden" class="form-control" name="prev_id" id="prev_admin_id" placeholder="Admin PREV Id">
                                <input type="hidden" class="form-control" name="prev_password" id="prev_admin_password" placeholder="Admin PREV Password">
                                <input type="hidden" class="form-control" name="prev_avatar" id="prev_avatar" placeholder="Prev Avatar Name">

                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your First Name">
                                <label for="firstname">First Name:</label>
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Enter your Last Name">
                                <label for="lastname">Last Name:</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="email" id="email" placeholder="User Name">
                                <label for="email">Email Address:</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating">
                                <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar">
                                <label for="avatar">Avatar:</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <label for="floatingPassword">Password:</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="confirmpassword" id="confirmPassword" placeholder="Confirm Password">
                        <label for="confirmPassword">Confirm Password:</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-success update-admin-btn"  type="submit" >Update admin</button>
          </form>
        </div>
      </div>
  </div>
</div>
            </div>
        </div>

<script src="../js/edit-admin.js"></script>
<?php
  require './template/footer.php';

?>