<?php
require "../config/database.php";



$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$category_title = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if(($category_title)){


    $update_category_query = "UPDATE category SET category_title='$category_title' WHERE id = $id LIMIT 1";
    $insert_category_result = mysqli_query($dbconnect, $update_category_query);
    echo "success";
}
