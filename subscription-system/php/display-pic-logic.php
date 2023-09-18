<?php

//fetch current user's Information from database
if (isset($_SESSION['user_id'])) {
    
    $current_user_id = $_SESSION['user_id'];
    
        $admin_query = "SELECT avatar FROM admins WHERE id = $current_user_id LIMIT 1";
        $admin_info = mysqli_query($dbconnect, $admin_query);
        
        $admin = mysqli_fetch_assoc($admin_info);
   
}

        ?>