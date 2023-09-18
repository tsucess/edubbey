<?php
    require "../config/database.php";

    $course = mysqli_real_escape_string($dbconnect, $_POST['course']);
    $course = strtoupper($course);
    $amount = mysqli_real_escape_string($dbconnect, $_POST['amount']);
    
    if(isset($_POST['category'])){
        $category_id = mysqli_real_escape_string($dbconnect, $_POST['category']);
    }

    if(!empty($category_id) && !empty($course)){

                // let's insert all data inside table
                $insert_query = "INSERT INTO course (category_id, course_title, amount, is_selected) VALUES ( '$category_id', '$course', $amount, 0)";
                $insert_sql = mysqli_query($dbconnect, $insert_query);
    
                if ($insert_sql) {
                        echo "success";
                } else {
                    echo "Something went wrong";
                }

    }else {
        echo "All input field are required"; 
    }
?>