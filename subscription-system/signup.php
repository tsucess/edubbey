<?php
require 'config/database.php';



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Qur'an competition</title>
    <link rel="icon" type="image/x-icon" href="../../img/brand/xsm-logo.png">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>


    <section class="form-section text-center">
        <main class="form-signin w-100 m-auto">
            <a class="navbar-brand" href="../index.php"><img class="brand" src="../img/brand/xsm-logo.png" alt="Sevenskies"></a>
            <!-- <h3 class="h3 mb-2 fw-normal">Qur'an Competition</h3> -->
            <h3 class="h3 my-4 fw-normal">Please sign up</h3>

            <form class="signup-form" enctype="multipart/form-data" >
                <div class="form-floating">
                    <div class="error-txt"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="fname" class="form-control" id="floatingFistName"
                                placeholder="Enter your First Name">
                            <label for="floatingFistName">First Name:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="lname" class="form-control" id="floatingLastName"
                                placeholder="Enter your Last Name">
                            <label for="floatingLastName">Last Name:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="uname" class="form-control" id="floatingUserName" placeholder="Enter your Email Address">
                            <label for="floatingUserName">Email Address:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" name="avatar" class="form-control" id="avatar" placeholder="School Logo">
                            <label for="avatar">School Avatar:</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="" placeholder="Password">
                    <label for="floatingPassword">Password:</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="confirmpassword" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                    <label for="confirmPassword">Confirm Password:</label>
                </div>

                <button class="btn w-100 btn-primary btn-rounded border rounded-pill signin-btn text-dark" type="submit">Sign up</button>
                <p class="text-muted mt-3">Already have an account
                    <a href="index.php">Sign in</a>
                </p>
                <p class="mt-4 mb-3 text-muted"> <a href="signup.php">&copy;</a> Copyright 2023 EDUBBEY DYNAMIC SOLUTIONS LIMITED</p>
            </form>
        </main>
    </section>



    <script src="./js/signup.js" ></script>
</body>

</html>