<?php
include "../config/database.php";



$current_user_id = $_SESSION['user_id'];

if (isset($_GET['id']) && isset($_GET['page'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $url =  $_GET['page'];

    // fetch form from the database  in order to delete form
    $query = "SELECT * FROM transactions WHERE id = $id LIMIT 1";
    $result = mysqli_query($dbconnect, $query);
 
    //make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
      
            // delete Registrateion from database
            $delete_txn_query = "DELETE FROM transactions WHERE id=$id LIMIT 1";
            $delete_txn_result = mysqli_query($dbconnect, $delete_txn_query);
            if (!mysqli_errno($dbconnect)) {
                $_SESSION['delete-form-success'] = "Transaction Deleted successfully";
        }
    }

    $res = mysqli_fetch_assoc($result);
}

header('location: ' . ROOT_URL . 'backend/'.$url.'.php?id='.$res['user_id']);
die();
