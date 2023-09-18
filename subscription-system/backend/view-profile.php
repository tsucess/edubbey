<?php
$title = "View Profile";
$page = "manage-users";
$url = "view-profile";

require './template/header-links.php';
require './template/header.php';


if (isset($_GET['id'])) {
$userId = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $userId";
$users = mysqli_query($dbconnect, $query);
$user = mysqli_fetch_assoc($users);


$query_history = "SELECT * FROM transactions WHERE user_id = $userId";
$sub_histroy = mysqli_query($dbconnect, $query_history);

}
  $query2 = "SELECT * FROM category";
  $categories = mysqli_query($dbconnect, $query2);
  

?>

<body>
    <div class="container-fluid"> 
        <div class="row">
                  <!-- sidebar  -->
            <?php require './template/sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2 class="display-6 fw-bold text-center" >Manage Users</h2> 
                        <a href="manage-users.php" class="btn btn-primary px-5">Back</a>
                    </div>     
                    <div class="container ">
                        <div class="row mt-5 mb-3">
                            <div class="col-md-12">
                                <h4 class="display-6 text-center">Profile</h4>
                            </div>
                        </div>
                        <div class="row justify-content-center pb-4 mx-auto">
                            <div class="col-10 col-md-6 col-lg-4 p-4 ">
                                <div class="avatar-display">
                                    <img class="image-banner" src=" <?= ROOT_URL . 'img/users-img/'.$user['avatar'] ?>" alt="" srcset="">
                                </div> 
                            </div>
                            <div class="col-12 col-md-12 col-lg-6">
                                <div class="table-responsive custom-table-responsive">
                                    <table class="table display-profile table-striped table-md">
                                        <tbody>
                                            <tr>
                                                <th>Name:</th>
                                                <td><?= "{$user['firstname']} {$user['lastname']}"  ?></td>
                                            </tr>
                                            <tr>
                                                <th>School:</th>
                                                <td><?= $user['school'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td><?= strtoupper($user['country']) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive custom-table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Courses</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Expiry Date</th>
                                    <!-- <th scope="col">Invoice</th> -->
                                    <th scope="col">Status</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($sub_histroy) > 0)
                                    {

                                    while( $history = mysqli_fetch_assoc($sub_histroy)) {
                                        $today=date('Y-m-d H:i:s');
                                        $expire = $history['expire_date'];

                                        if ($today > $expire){
                                        $status_update = "UPDATE transactions SET status = 0";
                                        $status_result = mysqli_query($dbconnect, $status_update);
                                        }
                                    ?>
                                        <tr>
                                            <td><b><?= $history['created'] ?></b></td>             
                                            <td><?= $history['courses_title'] ?></td>             
                                            <td><b>$ <?= $history['paid_amount'] ?></b> </td>             
                                            <td><?= $history['expire_date'] ?></td>  
                                            <!-- <td><a href="<?= ROOT_URL ?>backend/invoice.php?id=<?= $history['id'] ?>"  class="btn btn-warning">Print</a></td>  -->
                                            <?php if($history['status'] == 1): ?>     
                                                <td style="color: green">Active</td>   
                                                <?php else: ?>     
                                                <td style="color: red">Expired</td>   
                                                <?php endif ?>    
                                            <td><a onclick="validate(this)" href="<?= ROOT_URL ?>php/delete-transaction.php?id=<?= $history['id'] ?>&page=<?= $url ?>"  class="btn btn-danger">Delete</a></td>
                                        </tr>
                                        <tr class="spacer">
                                            <td colspan="4"></td>
                                        </tr>
                                <?php } 
                                    } else {  ?>
                                    <tr>
                                        <td colspan="7" class="text-center p-2"> No Subcription History</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
            </main>
        </div>
    </div>
   <?php require './template/footer.php'; ?> 