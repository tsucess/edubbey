<?php



function connect()
{
    // connect to the database;
    $dbconnect =  new mysqli("localhost", 'success', 'Taofeeq1993@', 'quran_competition');

    if (mysqli_error($dbconnect)) {
        die(mysqli_error($dbconnect));
    } else {
        return $dbconnect;
    }
}



if (isset($_POST['filtervalue'])) {
    $filtervalue = $_POST['filtervalue'];
    $filter = $_POST['filters'];

    if ($filter === "all") {
        $user = getAllData();
        echo json_encode($user);
   
    } else if ($filter === "year") {
        $user = getDataByYear($filtervalue);
        echo json_encode($user);
        
    } else if ($filter === "yearcategory") {
        $filteryearvalue = $_POST['filteryearvalue'];
        $user = getYearcategory($filtervalue, $filteryearvalue);
        echo json_encode($user);
    }
}



function getAllData()
{
    $dbconnect = connect();

    //fetch all forms from database
    $query = "SELECT *  FROM user";
    $users_result = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users_result) > 0) {
        while ($users = mysqli_fetch_assoc($users_result)) {
            $user[] = $users;
        }
        return $user;
    } else {
        return "success";
    }
}


function getDataByYear($filtervalue)
{
    $dbconnect = connect();
    //fetch all forms from database
    
        $query = "SELECT u.*, r.score, r.comments  FROM users u, results r WHERE u.id = r.user_id AND YEAR(datecreated) = $filtervalue";
        $users_result = mysqli_query($dbconnect, $query);
    
        if (mysqli_num_rows($users_result) > 0) {
            while ($users = mysqli_fetch_assoc($users_result)) {
                $user[] = $users;
            }
            return $user;
        } else {
            return "success";
        }
             
}
// year = $filteryear

function getYearcategory($filtercategory, $filteryear)
{
    $dbconnect = connect();
    //fetch all forms from database     
    $query = "SELECT u.*, r.score, r.comments  FROM users u, results r WHERE u.id = r.user_id AND category_id = '$filtercategory' AND YEAR(datecreated) = $filteryear";
    $users_result = mysqli_query($dbconnect, $query);

    if (mysqli_num_rows($users_result) > 0) {
        while ($users = mysqli_fetch_assoc($users_result)) {
            $user[] = $users;
        }
        return $user;
    } else {
        return "success";
    }
}


