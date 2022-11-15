<?php 
    include('../includes/connect.php');
    include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - User Registration</title>

    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>
<body>
    
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>

        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
            <form method="post" action="" enctype="multipart/form-data">
                <!-- username field -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter your name" name="username" autocomplete="off" required="required">
                </div>

                <!-- email field -->
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="user_email" placeholder="Enter your email" name="user_email" autocomplete="off" required="required">
                </div>

                <!-- image field -->
                <div class="mb-3">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" class="form-control" id="user_image" name="user_image"  required="required">
                </div>

                <!-- password field -->
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" placeholder="Enter your password" name="user_password" autocomplete="off"  required="required">
                </div>

                 <!-- confirm password field -->
                 <div class="mb-3">
                    <label for="user_confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="user_confirm_password" placeholder="Enter your password" name="user_confirm_password" autocomplete="off" required="required">
                </div>

                <!-- address field -->
                <div class="mb-3">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="user_address" placeholder="Enter your address" name="user_address" autocomplete="off" required="required">
                </div>

                <!-- contact filed -->
                <div class="mb-3">
                    <label for="user_mobile" class="form-label">Mobile</label>
                    <input type="text" class="form-control" id="user_mobile" placeholder="Enter your mobile number" name="user_mobile" autocomplete="off" required="required">
                </div>
                
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="btn btn-info text-white rounded-0 px-5" name="user_register">
                    <p class="mt-2 mb-0 text-small fw-bold">Already have an account ?<a href="user_login.php" class="text-danger"> Login</a></p>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>


<?php 

if(isset($_POST['user_register'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $user_confirm_password = $_POST['user_confirm_password'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip_address = getIPAddress();

    move_uploaded_file($user_image_tmp, "user_images/$user_image");

    // select query
    $select_query = "SELECT * FROM `user_table` WHERE `username`='$username' or `user_email`='$user_email'";
    $select_result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($select_result_query);

    if($num_of_rows > 0) {
        echo "<script>alert('Username and Email already exists!')</script>";
    } else if($user_password != $user_confirm_password) {
        echo "<script>alert('Passwords do not match')</script>";
    }
    else {
    $insert_query = "INSERT INTO `user_table`(`username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES ('$username','$user_email','$user_hash_password','$user_image','$user_ip_address','$user_address','$user_mobile')";
    
    $result_query = mysqli_query($con, $insert_query);
    
    if($result_query) {
        echo "<script>alert('User register successfully!')</script>";
        // echo "<script>window.open('user_login.php')</script>";
    }
    }

    // selecting cart item
    $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip_address'";
    $result_cart_query = mysqli_query($con, $select_cart_items);
    $num_of_rows = mysqli_num_rows($result_cart_query);

    if($num_of_rows > 0) {
        $_SESSION['username'] = $username;
        echo "<script>alert('You have items in your cart!')</script>";
        echo "<script>window.open('../checkout.php', '_self')</script>";
    } else {
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}

?>