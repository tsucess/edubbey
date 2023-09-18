<?php

require "../config/database.php";

    ini_set('display_errors', 1);
    error_reporting(E_ALL);


if($_POST['fname']){

    $from = "admin@sevenskiesportal.edu.my"; //Mail created form your site
    $to = "taofeeq.muhammad22@gmail.com";   // Receiver Address
    
    $fname = mysqli_real_escape_string($dbconnect, $_POST['fname']); // User First Name
    $useremail = mysqli_real_escape_string($dbconnect, $_POST['email']); // User Email

    $subject = $fname. " ". $useremail; // Subject
    $message = $_POST['message']; // Message-Body
    $headers = "From:".$from; 
    
    mail($to, $subject, $message, $headers);
    
        $_SESSION['success'] = "The email message was successfully sent.";
        
}
    header('location: ' . ROOT_URL .'index.php');
            die();
?>  