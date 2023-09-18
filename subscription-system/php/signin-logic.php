<?php
require "../config/database.php";
    
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
  
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

if (!empty($email) && !empty($password)) {
    // hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // let's check users entered email & password matched to database any table row email and password
    $adminsql = "SELECT * FROM admins WHERE email = '$email'";
    $sql_result = mysqli_query($dbconnect, $adminsql);

    $usersql = "SELECT * FROM users WHERE email = '$email'";
    $usersql_result = mysqli_query($dbconnect, $usersql);


    if (mysqli_num_rows($sql_result) === 1) { // if credentials matched
        $rowadmin = mysqli_fetch_assoc($sql_result);

        $db_password = $rowadmin['userpassword'];

        if (password_verify($password, $db_password)) {
            
            $_SESSION['user_id'] = $rowadmin['id']; // using this session we used user unique_id in other php file
            if (isset($_SESSION['user_id'])) {

                echo "adminsuccess";
            }
        } else {
            echo "email or Password is incorrect!";
        }
    } elseif (mysqli_num_rows($usersql_result) === 1){

        $row = mysqli_fetch_assoc($usersql_result);

        $db_password = $row['userpassword'];

        if (password_verify($password, $db_password)) {

            $_SESSION['user_id'] = $row['id']; // using this session we used user unique_id in other php file
            if (isset($_SESSION['user_id'])) {

                echo "usersuccess";
            }
        } else {
            echo "email or Password is incorrect!";
        }

}else {
            echo "Account does not exist!";
        }

    } else {
        echo "All input fields are required!";
    }


?>