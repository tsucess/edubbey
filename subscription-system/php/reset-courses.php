<?php
require "../config/database.php";

    $is_selected = 0;
    
    $update_course_query = "UPDATE course SET is_selected = $is_selected";
    $insert_course_result = mysqli_query($dbconnect, $update_course_query);

if($insert_course_result){
    header('location: ' . ROOT_URL . 'backend/index.php');
            die();
    echo "success";
}

