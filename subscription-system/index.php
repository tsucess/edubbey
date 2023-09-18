<?php
require 'config/database.php';



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ogunsanya Taofeeq, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Signin page</title>
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
            <h3 class="h3 my-4 mt-4 fw-normal">Please sign in</h3>
            <form class="signin-form" enctype="multipart/form-data">
                <div class="form-floating">
                    <div class="error-txt"></div>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="email" id="floatingUserName" placeholder="User Name">
                    <label for="floatingUserName">Email Address:</label>
                </div>
                <div class="form-floating">
                    <input type="password"  class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password:</label>
                </div>
                <button class="btn w-100 btn-primary btn-rounded border rounded-pill signin-btn text-dark" type="submit">Sign in</button>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mt-3">Don't have an account
                            <a href="../index.php"><b>Sign up</b></a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mt-3">
                            <a href="forgetpassword.php"><b>Forgot password</b></a>
                        </p>
                    </div>
                </div>
                <p class="mt-4 mb-3 text-muted"> <a href="signup.php">&copy;</a> Copyright 2023 EDUBBEY DYNAMIC SOLUTIONS LIMITED</p>
            </form>
        </main>
    </section>  

    <script src="./js/signin.js" ></script>
</body>

</html>