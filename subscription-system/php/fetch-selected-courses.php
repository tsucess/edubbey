<?php
    require "../config/database.php";

        if(isset($_SESSION['user_id'])){
      
            $fetch_course_query = "SELECT * FROM course";
            $fetch_course_result = mysqli_query($dbconnect, $fetch_course_query);

            if(mysqli_num_rows($fetch_course_result) > 0){
                $course_data = array();
                while($course = mysqli_fetch_assoc($fetch_course_result)){
                    $course_data[] = $course;
                }
                header('Content-Type: application/json');
                echo json_encode($course_data);
            }
            

        }