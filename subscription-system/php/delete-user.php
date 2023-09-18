<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch form from the database  in order to delete form from images folder
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($dbconnect, $query);

    
 
    //make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $user_thumbnail_name = $user['avatar'];
        $user_thumbnail_path = '../img/users-img/'.$user_thumbnail_name;

        // delete image if available
        if ($user_thumbnail_path) {
            unlink($user_thumbnail_path);
        
            // delete category from database;
            $delete_participant_query = "DELETE FROM users WHERE id=$id LIMIT 1";
            $delete_participant_result = mysqli_query($dbconnect, $delete_participant_query);

            $query_result = "DELETE FROM results WHERE participant_id = $id LIMIT 1";
            $delete_result = mysqli_query($dbconnect, $query_result);

            if (!mysqli_errno($dbconnect)) {
                $_SESSION['delete-form-success'] = "User Deleted successfully";
        }
    }
    }
}

header('location: ' . ROOT_URL . 'backend/manage-users.php');
die();
