<?php
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);

if(isset($_POST['g-recaptcha-response']) && isset($_POST['submit'])){
    
    
    $secretkey = "";
    // $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response";
    
    $file = file_get_contents($url);
    $data = json_decode($file);
    
    if ($data->success==true){
        
        $from = "info@edubbey.com"; //Mail created form your site
        $to = "ogunsanya.taofeeq@edubbey.com";   // Receiver Address
    
    $fname = filter_var($_POST['fname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // User First Name
    $lname = filter_var($_POST['lname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // User Last Name
    $useremail = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS); // User Email

    $subject = $fname . " ". $lname . " ". $useremail; // Subject
    $message = $_POST['message']; // Message-Body
    $headers = "From:".$from; 
    
    mail($to, $subject, $message, $headers);
    
    $_SESSION['notify'] = "The email message was successfully sent.";
        
    } 
    else
    {
        $_SESSION['notify'] = "Please validate Recaptcha";
    }
    
    
} else {
    
    $_SESSION['notify'] = "Recaptcha Error!";
}
        header('location:https://edubbey.com/index.php');
            die();

?>  