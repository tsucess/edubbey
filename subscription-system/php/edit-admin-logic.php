<?php
require "../config/database.php";



$id = filter_var($_POST['prev_id'], FILTER_SANITIZE_NUMBER_INT);
$prev_avatar = $_POST['prev_avatar'];
$prev_password = $_POST['prev_password'];

$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$avatar = $_FILES['avatar'];


if (!empty($firstname) && !empty($lastname) && !empty($email)) {
    // check if the email already exist
    $query = "SELECT email FROM admins WHERE email = '$email' AND id != $id";
    $sql = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($sql) > 0) {
        echo "$email - This email already exist...";
    } else {




       


            //work on document
            //deleting existing document if new document is available
            if ($avatar['name']) {
            $prev_avatar_path = '../img/admin-img/'.$prev_avatar;
            if ($prev_avatar_path) {
                unlink($prev_avatar_path);
            }
    
    
    
            // Checking Document Properties: size and file 
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = '../img/admin-img/'.$avatar_name;
    
            // image validation
            $image_format = ['jpeg', 'jpg', 'png'];
            $image_ext = explode('.', $avatar_name);
            $image_ext = end($image_ext);
    
            if (in_array($image_ext, $image_format)) {
                // chck document size 
                if ($avatar['size'] < 2000000) {
                    // upload Document
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                } else {
                    echo "File size too big. should be less than 2mb";
                }
            } else {
                echo "please select an Image file - png, jpeg, or jpg!";
            }
        }
    //set avatar name if a new one was uploaded,else keep old avatar name
    // $password_to_insert = $hashed_password ?? $prev_password;

    $avatar_to_insert = $avatar_name ?? $prev_avatar;

    if (!empty($password)) {
        if ($password !== $confirmpassword) {
                echo "Passwords do not match";
            } else {
                // hash password
                $hashed_password = password_hash($confirmpassword, PASSWORD_DEFAULT);
                $update_category_query = "UPDATE admins SET firstname='$firstname', lastname='$lastname', email='$email', userpassword='$hashed_password' WHERE id = $id LIMIT 1";
                $insert_category_result = mysqli_query($dbconnect, $update_category_query);
                echo "success";
            }
        } else{
            $hashed_password = $prev_password;
            $update_category_query = "UPDATE admins SET firstname='$firstname', lastname='$lastname', email='$email', userpassword='$hashed_password' WHERE id = $id LIMIT 1";
            $insert_category_result = mysqli_query($dbconnect, $update_category_query);
            echo "success";
        }




}
    }
