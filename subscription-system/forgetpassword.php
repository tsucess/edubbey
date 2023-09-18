<?php
require './config/database.php';

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = strtoupper($email);

    if(!$email) {
        $_SESSION['forgotpass'] = "Enter your email";
    } else {
        // check if email exist in the database
        $admincheck_query = "SELECT * FROM admins WHERE email = '$email'";
        $admincheck_result = mysqli_query($dbconnect, $admincheck_query);

        //check if participant already registered
        $user_check_query = "SELECT * FROM users WHERE email = '$email'";
        $user_check_result = mysqli_query($dbconnect, $user_check_query);


        if (mysqli_num_rows($admincheck_result) > 0 || mysqli_num_rows($user_check_result) > 0) {

            header('location: ' . ROOT_URL . 'createpassword.php');
            die();
        } else {
            $_SESSION['forgotpass'] = "User Account doesn't exist";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>forgot passsord</title>


    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>

    <section class="form-section text-center">
        <main class="form-signin w-100 m-auto">
        <a class="navbar-brand" href="../index.php"><img class="brand" src="../img/brand/xsm-logo.png" alt="EDUBBEY"></a>
            <h3 class="h3 my-4 mt-5 fw-normal">Confirm User Account</h3>
            <?php if (isset($_SESSION['forgotpass-success'])) : ?>
                <div class="alert_message success">
                    <p> <?= $_SESSION['forgotpass-success'];
                    unset($_SESSION['forgotpass-success']);
                    ?>
                    </p>
                </div>
                <?php elseif (isset($_SESSION['forgotpass'])) : ?>
                    <div class="alert_message error">
                        <p> <?= $_SESSION['forgotpass'];
                    unset($_SESSION['forgotpass']);
                    ?>
                        </p>
                    </div>
                    <?php endif ?>
            <form action="forgetpassword.php" method="POST">
                <div class="form-floating">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address">
                    <label for="email">Email Address:</label>
                </div>
                <input class="w-100 btn btn-lg btn-primary" type="submit" value="Submit">

                <p class="text-muted mt-3">
                    <a href="index.php">Back</a>
                </p>
                <p class="mt-4 mb-3 text-muted"> <a href="signup.php">&copy;</a> Copyright 2023 EDUBBEY DYNAMIC SOLUTIONS LIMITED</p>
            </form>
        </main>
    </section>

</body>

</html>