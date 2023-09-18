<?php
require "../config/database.php";



$id = filter_var($_POST['prev_id'], FILTER_SANITIZE_NUMBER_INT);
$course = filter_var($_POST['courseEdit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$amount = filter_var($_POST['amountEdit'], FILTER_SANITIZE_NUMBER_INT);
$category = filter_var($_POST['categoryEdit'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if(!empty($course) || !empty($category)){

    $update_course_query = "UPDATE course SET category_id ='$category', course_title ='$course', amount =$amount  WHERE id = $id LIMIT 1";
    $insert_course_result = mysqli_query($dbconnect, $update_course_query);
    echo "success";
} else{
    echo "Fill an inputs";
}