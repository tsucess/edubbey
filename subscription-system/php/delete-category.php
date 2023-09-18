<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch form from the database  in order to delete form from images folder
    $query = "SELECT * FROM category WHERE id = $id";
    $result = mysqli_query($dbconnect, $query);

 
    //make sure we got back only one user 
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
        
            // delete category from database;
            $delete_category_query = "DELETE FROM category WHERE id=$id LIMIT 1";
            $delete_category_result = mysqli_query($dbconnect, $delete_category_query);
            if (!mysqli_errno($dbconnect)) {
                $_SESSION['delete-form-success'] = "Category Deleted successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'backend/manage-categories.php');
die();
