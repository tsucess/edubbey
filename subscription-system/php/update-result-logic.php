<?php
require "../config/database.php";


if(isset($_POST['id'])){

    if (isset($_POST['score']) || isset($_POST['comment'])) {
        
        $score = $_POST['score'];
        $comment = $_POST['comment'];
        $id = $_POST['id'];


        // check if the user id already exist in the result table
        $query = "SELECT * FROM results WHERE participant_id = $id";
        $sql = mysqli_query($dbconnect, $query);

        if(mysqli_num_rows($sql) > 0){
            $data = mysqli_fetch_assoc($sql);
            $prev_score = $data['score'];
            $prev_comment = $data['comments'];
            
            if($score === 'undefined'){
                // $update_score = $prev_score;
                $update_result_query = "UPDATE results SET comments = '$comment'  WHERE participant_id = $id";
                $update_results = mysqli_query($dbconnect, $update_result_query);
                
                if ($update_results) {
                    echo "success";
                    } else {
                        echo "Something went wrong, Couldn't update result data";
                    }

            }else if($comment === 'NULL') {
                // $update_score = $score;
                $update_result_query = "UPDATE results SET score = $score  WHERE participant_id = $id";
                $update_results = mysqli_query($dbconnect, $update_result_query);
                if ($update_results) {
                        echo "success";
                    } else {
                        echo "Something went wrong, Couldn't update result data";
                    }
            }

            // $update_result_query = "UPDATE results SET score = $update_score, comments = '$update_comment'  WHERE participant_id = $id";
            // $update_results = mysqli_query($dbconnect, $update_result_query);

            

        } else{
           $insert_result_query = "INSERT INTO results (participant_id, score, comments) VALUES ($id, $score, '$comment')";
           $insert_result = mysqli_query($dbconnect, $insert_result_query);

                if ($insert_result) {
                    echo "success";
                    } else {
                        echo "Something went wrong, Couldn't insert result data";
                    }

        }


    } else{
        
        echo $score, $comment, $id;
    }
}
