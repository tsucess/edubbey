<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch form from the database  in order to delete form from images folder
    $query = "SELECT * FROM admins WHERE id = $id";
    $result = mysqli_query($dbconnect, $query);

 
    //make sure we got back only one user
    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        $admin_thumbnail_name = $admin['avatar'];
        $admin_thumbnail_path = '../img/admin-img/'.$admin_thumbnail_name;

        // delete image if available
        if ($admin_thumbnail_path) {
            unlink($admin_thumbnail_path);

            // delete admin from database;
            $delete_admin_query = "DELETE FROM admins WHERE id=$id LIMIT 1";
            $delete_admin_result = mysqli_query($dbconnect, $delete_admin_query);
            if (!mysqli_errno($dbconnect)) {
                $_SESSION['delete-form-success'] = "Account Deleted successfully";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'backend/manage-admin.php');
die();
