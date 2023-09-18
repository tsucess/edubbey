<?php
include "../config/database.php";



$current_user_id = $_SESSION['user_id'];

if (isset($_GET['sub-id'])) {
    $id = filter_var($_GET['sub-id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch form from the database  in order to delete form
    $query = "SELECT * FROM txn_details WHERE users_id = $current_user_id AND sub_id = $id OR payment_status = 'pending'";
    $result = mysqli_query($dbconnect, $query);
 
    //make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
        // $course = mysqli_fetch_assoc($result);

            // delete Registrateion from database
            $delete_txn_query = "DELETE FROM txn_details WHERE users_id = $current_user_id AND sub_id=$id OR payment_status = 'pending'";
            $delete_txn_result = mysqli_query($dbconnect, $delete_txn_query);
            if (!mysqli_errno($dbconnect)) {
                $_SESSION['delete-form-success'] = "Question Deleted successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'backend/subscribe.php');
die();
