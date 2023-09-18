<?php
require "./config/database.php";

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = strtoupper($email);
    $confirmpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (empty($email)) {
        $_SESSION['resetpassword'] = "Enter your email";
    } else {

        if ($confirmpassword !== $confirmpassword) {
            $_SESSION['resetpassword'] = "Passwords do not match";
        } else {
            // hash password 
            $hashed_password = password_hash($confirmpassword, PASSWORD_DEFAULT);

            //check if email exist in the admin table 
            $admincheck_query = "SELECT * FROM admins WHERE email = '$email'";
            $admincheck_result = mysqli_query($dbconnect, $admincheck_query);

            //check if email exist in the users table 
            $user_check_query = "SELECT * FROM users WHERE email = '$email'";
            $user_check_result = mysqli_query($dbconnect, $user_check_query);


            if (mysqli_num_rows($user_check_result) > 0 || mysqli_num_rows($admincheck_result) > 0) {

                if (mysqli_num_rows($user_check_result) > 0) {

                    //update the new password of the User
                    $update_user_query = "UPDATE users SET  userpassword= '$hashed_password' WHERE email = '$email' LIMIT 1";
                    $update_user_result = mysqli_query($dbconnect, $update_user_query);
                } else {
                    //update the new password of the Admin
                    $update_admin_query = "UPDATE admins SET  userpassword= '$hashed_password' WHERE email = '$email' LIMIT 1";
                    $update_admin_result = mysqli_query($dbconnect, $update_admin_query);
                }
            } else {
                $_SESSION['resetpassword'] = "User account does not exist";
            }
        }
        if (isset($_SESSION['resetpassword'])) {

            // pass form data back to resetpassword page
            $_SESSION['resetpassword-data'] = $_POST;
        } else {

            header('location: ' . ROOT_URL . 'index.php');
            die();
        }
    }
}

$email = $_SESSION['resetpassword-data']['email'] ?? null;
$psword = $_SESSION['resetpassword-data']['createpassword'] ?? null;
$cpsword = $_SESSION['resetpassword-data']['confirmpassword'] ?? null;


unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create new password</title>
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>

    <section class="form-section text-center">
        <main class="form-signin w-100 m-auto">
        <a class="navbar-brand" href="../index.php"><img class="brand" src="../img/brand/xsm-logo.png" alt="EDUBBEY"></a>
            <h3 class="h3 my-4 mt-4 fw-normal">Create New Password</h3>
            <?php if (isset($_SESSION['resetpassword'])) : ?>
                <div class="alert_message error">
                    <p> <?= $_SESSION['resetpassword'];
                        unset($_SESSION['resetpassword']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form class="signin-form" action="createpassword.php" method="POST">
            <div class="form-floating">
                    <div class="error-txt"></div>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="email" id="floatingemail" value="<?= $email ?>"  placeholder="Enter Email Address">
                    <label for="floatingemail">Email Address:</label>
                </div>
                <div class="form-floating">
                    <input type="password"  class="form-control" name="createpassword" id="floatingPassword" value="<?=  $psword ?>" placeholder="Password">
                    <label for="floatingPassword">Password:</label>
                </div>
                <div class="form-floating">
                    <input type="password"  class="form-control" name="confirmpassword" id="floatingPassword" value="<?=  $cpsword ?>"placeholder="Re-Enter Password">
                    <label for="floatingPassword">Confirm Password:</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary signin-btn" type="submit">Create Password</button>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mt-3">
                            <a href="index.php">Cancel</a>
                        </p>
                    </div>
                    
                </div>
                <p class="mt-4 mb-3 text-muted"> &copy; Copyright 2023 <a href="#">EDUBBEY DYNAMIC SOLUTIONS LIMITED</a> </p>
            </form>
        </main>
    </section>

</body>

</html>
