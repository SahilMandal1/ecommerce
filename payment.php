<?php 
    include('includes/connect.php');
    // include('functions/common_functions.php');
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

     <link rel="stylesheet" href="style.css">

</head>
<body>
    
    <!-- php code -->
    <?php 
        $ip_address = getIPAddress();
        $get_user = "SELECT * FROM `user_table` WHERE user_ip='$ip_address'";
        $result_query = mysqli_query($con, $get_user);
        $row_data = mysqli_fetch_array($result_query);
        $user_id = $row_data['user_id'];

    ?>

    <div class="container mt-3">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row justify-content-center d-flex align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.paypal.com"><img class="upi_image" src="images/upi.jpg" target="_blank" alt=""></a>
            </div>
            <div class="col-md-6">
                <a href="./user_area/order.php?user_id=<?php echo $user_id?>"><h2 class="text-center">Pay offline<h2></a>
            </div>
        </div>
    </div>
</body>
</html>