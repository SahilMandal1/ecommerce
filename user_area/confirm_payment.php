<?php 
    include('../includes/connect.php');
    session_start();

    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $select_query = "SELECT * FROM `user_orders` WHERE order_id=$order_id";
        $result_query = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_assoc($result_query);
    
        $invoice_number = $row_data['invoice_number'];
        $amount = $row_data['amount_due'];
    }

    if(isset($_POST['confirm_payment'])) {
        $invoice_number = $_POST['invoice_number'];
        $amount = $_POST['amount'];
        $payment_mode = $_POST['payment_mode'];

        // Insert query
        $insert_query = "INSERT INTO `user_payments`(`order_id`, `invoice_number`, `amount`, `payment_mode`) VALUES ($order_id,$invoice_number,$amount,'$payment_mode')";
        $insert_result = mysqli_query($con, $insert_query);

        if($insert_result) {
            echo "<script>alert('Successfully completed the payment')</script>";
            echo "<script>window.open('./profile.php?my_orders', '_self');</script>";
        }

        $update_query = "UPDATE `user_orders` SET `order_status`='Completed' WHERE order_id=$order_id";
        $update_result = mysqli_query($con, $update_query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-secondary">
    <div class="container my-4">
        <h2 class="text-white text-center">Confirm Payment</h2>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-white mb-1"><b>Amount</b></label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="btn btn-info rounded-0 text-white px-5" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>