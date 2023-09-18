<?php
// Include configuration file  
require "config/database.php";

$current_user_id = $_SESSION['user_id'];

$payment_id = $statusMsg = '';
$status = 'error';

// Check whether stripe checkout session is not empty 
if ($_GET['session_id']) {
    $session_id = $_GET['session_id'];

    // Fetch transaction data from the database if already exists 
    $sqlQ = "SELECT * FROM transactions WHERE stripe_checkout_session_id = ?";
    $stmt = $dbconnect->prepare($sqlQ);
    $stmt->bind_param("s", $db_session_id);
    $db_session_id = $session_id;
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Transaction details 
        $transData = $result->fetch_assoc();
        $payment_id = $transData['id'];
        $transactionID = $transData['txn_id'];
        $paidAmount = $transData['paid_amount'];
        $paidCurrency = $transData['paid_amount_currency'];
        $payment_status = $transData['payment_status'];

        $customer_name = $transData['customer_name'];
        $customer_email = $transData['customer_email'];

        $status = 'success';
        $statusMsg = 'Your Payment has been Successful!';
    } else {
        // Include the Stripe PHP library 
        require_once 'stripe-php/init.php';

        // Set API key 
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

        // Fetch the Checkout Session to display the JSON result on the success page 
        try {
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $checkout_session) {
            // Get customer details 
            $customer_details = $checkout_session->customer_details;

            // Retrieve the details of a PaymentIntent 
            try {
                $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $paymentIntent) {
                // Check whether the payment was successful
                if (!empty($paymentIntent) && $paymentIntent->status == 'succeeded') {
                    
                    // Transaction details  
                    $transactionID = $paymentIntent->id;
                    $paidAmount = $paymentIntent->amount;
                    $paidAmount = ($paidAmount / 100);
                    $paidCurrency = $paymentIntent->currency;
                    $payment_status = $paymentIntent->status;

                    // Customer info 
                    $customer_name = $customer_email = '';
                    if (!empty($customer_details)) {
                        $customer_name = !empty($customer_details->name) ? $customer_details->name : '';
                        $customer_email = !empty($customer_details->email) ? $customer_details->email : '';
                    }

                    // Check if any transaction data is exists already with the same TXN ID 
                    $sqlQ = "SELECT id FROM transactions WHERE txn_id = ?";
                    $stmt = $dbconnect->prepare($sqlQ);
                    $stmt->bind_param("s", $transactionID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $prevRow = $result->fetch_assoc();

                    if (!empty($prevRow)) {
                        $payment_id = $prevRow['id'];
                    } else {

                        $today=date('Y-m-d H:i:s');
						$expire=date('Y-m-d H:i:s', strtotime($today. '+1 year'));
                        $active_status = 1;

                        // SUMMARY TXN_TABLE should be updated 
                        $update_subscribe_query = "UPDATE txn_details SET payment_status ='processed'  WHERE users_id = $current_user_id AND payment_status ='pending'";
                        $update_subscribe_result = mysqli_query($dbconnect, $update_subscribe_query);

                        // Insert transaction data into the database 
                        $sqlQ = "INSERT INTO transactions (user_name, user_email, user_id, customer_name, customer_email, courses_title, courses_id, total_price, total_price_currency, paid_amount, paid_amount_currency, txn_id, payment_status, stripe_checkout_session_id, expire_date, status, created) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
                        $stmt = $dbconnect->prepare($sqlQ);
                        $stmt->bind_param("ssissssdsdsssssi", $user_name, $user_email, $user_id, $customer_name, $customer_email, $courses_title, $courses_id, $totalPrice, $currency, $paidAmount, $paidCurrency, $transactionID, $payment_status, $session_id, $expire, $active_status);
                        $insert = $stmt->execute();

                        if ($insert) {
                            $payment_id = $stmt->insert_id;
                        }
                    }
                    $status = 'success';
                    $statusMsg = 'Your Payment has been Successful!';
                } else {
                    $statusMsg = "Transaction has been failed!";
                }
            } else {
                $statusMsg = "Unable to fetch the transaction details! $api_error";
            }
        } else {
            $statusMsg = "Invalid Transaction! $api_error";
        }
    }
} else {
    $statusMsg = "Invalid Request!";
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ogunsanya Taofeeq, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>success page</title>


    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body>

    <section class="form-section text-center">
        <main class="form-signin w-100 m-auto">
            <a class="navbar-brand" href="../../index.php"><img class="brand" src="../../img/brand/xsm-logo.png" alt="EDUBBEY"></a>
            <!-- <h3 class="h3 mb-3 fw-normal">Qur'an Competition System</h3> -->

            <?php 
                if (!empty($payment_id)) {
                    $update_subscribe_query = "UPDATE txn_details SET payment_status ='success'  WHERE users_id = $current_user_id AND payment_status ='processed'";
                    $update_subscribe_result = mysqli_query($dbconnect, $update_subscribe_query);
                    // $_SESSION['success'] =  "Your have Successfully Subscribed";
                    // header('location: ' . ROOT_URL . 'backend/index.php');
                    // die();
                ?>

                <h3 class="<?php echo $status; ?>"><?php echo $statusMsg; ?></h3>
                <p> Click to <a href="index.php"> <b>HERE</b></a> to go back to dashboard</p>
                <?php } else { ?>
                    <h1 class="error">Your Payment been failed!</h1>
                    <p class="error"><?php echo $statusMsg; ?></p>
                <?php } ?>
            
        </main>
    </section>

    <script src="./js/signin.js" ></script>
</body>

</html>


























