<?php
    require "../config/database.php";

    $fname = mysqli_real_escape_string($dbconnect, $_POST['fname']);
    $fname = strtoupper($fname);
    $lname = mysqli_real_escape_string($dbconnect, $_POST['lname']);
    $lname = strtoupper($lname);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    // $email = strtoupper($email);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($dbconnect, $_POST['confirmpassword']);
    $avatar = $_FILES['avatar'];
  

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){



            // check if the email already exist 
           // check if the email already exist 
           $uquery = "SELECT email FROM users  WHERE email = '$email'";
           $sql = mysqli_query($dbconnect, $uquery);

           $admin_query = "SELECT email FROM admins WHERE email = '$email'";
           $admin_sql = mysqli_query($dbconnect, $query);

           if(mysqli_num_rows($sql) > 0 || mysqli_num_rows($amin_sql) > 0){
               echo "$email - This email already exist...";
           } else{

if ($password === $confirmpassword) {

        // hash password 
        $hashed_password = password_hash($confirmpassword, PASSWORD_DEFAULT);


    // file upload details
    $image_name = $avatar['name'];
    $image_type = $avatar['type'];
    $tmp_name = $avatar['tmp_name'];

    //let's explode image and get the extension eg. png, jpeg, jpg
    $img_explode = explode('.', $image_name);
    $img_ext = end($img_explode);
    $extensions = ['png', 'jpeg', 'jpg']; // these are the valid img ext stored in an array

    if (in_array($img_ext, $extensions) === true) {
        $time = time();

        $avatar_name = $time.$image_name;

        // chck image size 
        if($avatar['size'] < 2000000){

            if (move_uploaded_file($tmp_name, "../img/admin-img/".$avatar_name)) {
                // let's insert all data inside table
                $insert_query = "INSERT INTO admins (firstname, lastname, email, avatar, userpassword) VALUES ( '$fname', '$lname', '$email', '$avatar_name', '$hashed_password')";
                $insert_sql = mysqli_query($dbconnect, $insert_query);
    
                if ($insert_sql) {
                        echo "success";
                  
                } else {
                    echo "Something went wrong";
                }
            }
           
        }else{
            echo "File size too big. should be less than 2mb";
        }

    } else {
        echo "Please select an image file, jpeg, jpg or png!";
    }
} else{

    echo "Password do not match!";

}
          
            }

    }else {
        echo "All input field are required"; 
    }
?>