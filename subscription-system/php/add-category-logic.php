<?php
    require "../config/database.php";

    $category = mysqli_real_escape_string($dbconnect, $_POST['category']);
    $category = strtoupper($category);
    
  

    if(!empty($category)){

            // check if the category already exist 
            $query = "SELECT category_title FROM category WHERE category_title = '$category'";
            $sql = mysqli_query($dbconnect, $query);

            if(mysqli_num_rows($sql) > 0){
                echo "$category - This category already created...";
            } else{


                // let's insert all data inside table
                $insert_query = "INSERT INTO category (category_title) VALUES ( '$category')";
                $insert_sql = mysqli_query($dbconnect, $insert_query);
    
                if ($insert_sql) {
                        echo "success";
                  
                } else {
                    echo "Something went wrong";
                }
          
            }

    }else {
        echo "All input field are required"; 
    }
?>