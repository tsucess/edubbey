<?php
session_start();

/* 
* Stripe API configuration 
* Remember to switch to your live publishable and secret key in production! 
* See your keys here: https://dashboard.stripe.com/account/apikeys 
*/ 
define('STRIPE_API_KEY', 'sk_test_51M8gsDF40aFcudqwszr1s4EwHB2gSSU4n1QD8IuLUCzfnxKGj1UElNp3ukYbdNKnTirdrqO3FBYGkRVFLjGqZIH900OS0aBJDA'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51M8gsDF40aFcudqwf4fobv76bLGkR9wuY97zuN1qQ7bBtGzFuwTFIssJOnXyzYeNF7DyKrkXh0gbS8o4ixbk1PE5007S1edfLo');
define('STRIPE_SUCCESS_URL', 'http://localhost/edubbey/subscription-system/backend/payment-success.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'http://localhost/edubbey/subscription-system/backend/payment-cancel.php'); //Payment cancel URL 


define("ROOT_URL", "http://localhost/edubbey/subscription-system/");
define("DB_HOST", "localhost");
define("DB_USER", 'success'); 
define("DB_PASS", "Taofeeq1993@");
define("DB_NAME", "sub_system");


$current_user_id = $_SESSION['user_id'];

$dbconnects =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_error($dbconnects)){
    die(mysqli_error($dbconnects));
}

if(isset($_SESSION['process']) && isset($_SESSION['amount'])){

    // Change to users later 

    $fetch_user_query = "SELECT firstname, lastname, email  FROM  users WHERE id = $current_user_id";
    $fetch_user_result = mysqli_query($dbconnects, $fetch_user_query);
    



    $sql = "SELECT * FROM txn_details WHERE users_id = $current_user_id AND payment_status = 'pending' LIMIT 1";
    $query = mysqli_query($dbconnects, $sql);
    $txn_detail = mysqli_fetch_assoc($query);
    $subject = "Edubbey Subscription System";
    $user_id = $current_user_id;

    if(mysqli_num_rows($fetch_user_result) > 0){
        $user = mysqli_fetch_assoc($fetch_user_result);
        $user_name = "{$user['firstname']} {$user['lastname']}";
        $user_email = $user['email']; 
    }

    if($txn_detail){
        $courses_title = $txn_detail['courses_title'];  
        $courses_id = $txn_detail['courses_id'];  
    }
    $totalPrice = $_SESSION['amount']; 
    $currency = "usd";

}






?>