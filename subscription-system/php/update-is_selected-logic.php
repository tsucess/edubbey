<?php
require "../config/database.php";



if (isset($_POST['selectedValue']) && isset($_POST['courseId'])) {

    $is_selected = $_POST['selectedValue'];
    $id = $_POST['courseId'];

    $update_course_query = "UPDATE course SET is_selected = $is_selected WHERE id = $id LIMIT 1";
    $insert_course_result = mysqli_query($dbconnect, $update_course_query);


    echo "success";
} else{

    echo $is_selected, $id;
}
