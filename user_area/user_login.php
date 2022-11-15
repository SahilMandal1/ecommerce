<?php 
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - User Login</title>

    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>

        <div class="row mt-5 d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
            <form method="post" action="">
                <!-- username field -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter your name" required="required" name="username" autocomplete="off">
                </div>

                <!-- password field -->
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Enter your password" required="required" name="user_password" autocomplete="off">
                </div>
                
                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="btn btn-info text-white rounded-0 px-5" name="user_login">
                    <p class="mt-2 mb-0 text-small fw-bold">Don't have an account ?<a href="user_registration.php" class="text-danger"> Register</a></p>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

<?php 
    if(isset($_POST['user_login'])) {
        $username = $_POST['username'];
        $password = $_POST['user_password'];
        $ip_address = getIPAddress();

        $select_query = "SELECT * FROM `user_table` WHERE username='$username'";
        $result_query = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_assoc($result_query);
        $num_of_rows = mysqli_num_rows($result_query);

        // select cart item:
        $select_cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip_address'";
        $select_cart_result = mysqli_query($con, $select_cart_query);
        $num_of_rows_in_cart = mysqli_num_rows($select_cart_result);

        if($num_of_rows > 0) {
            $_SESSION['username'] = $username;
            if(password_verify($password, $row_data['user_password'])) {
               if($num_of_rows == 1 and $num_of_rows_in_cart == 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login Successful!')</script>";
                echo "<script>window.open('profile.php', '_self')</script>";
               } else {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login Successful!')</script>";
                echo "<script>window.open('../checkout.php', '_self')</script>";
               }
            } else {
                echo "<script>alert('Incorrect Password!')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    }
?>