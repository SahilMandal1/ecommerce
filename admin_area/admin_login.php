<?php 
    include('../includes/connect.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            overflow-x: hidden;
        }

        .registration_image {
            width: 90%;
            margin-right: 50px;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/login_image.webp" alt="Admin Registration" class="image-fluid registration_image">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required="required">
                    </div>
                    <div>
                        <p class="small mt-2 fw-bold pt-1"><a href="admin_login.php" class="text-danger">Forgot Password</a></p>
                        <input type="submit" value="Login" class="btn btn-info rounded-0 px-4" name="admin_login">
                        <p class="small mt-2 fw-bold pt-1"> Don't have an account? <a href="admin_registration.php" class="text-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php 
    if(isset($_POST['admin_login'])) {
        $admin_name = $_POST['username'];
        $admin_password = $_POST['password'];

        // select query
        $select_admin = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
        $admin_result = mysqli_query($con, $select_admin);
        $admin_data_fetch = mysqli_fetch_assoc($admin_result);
        $num_of_admin_row = mysqli_num_rows($admin_result);

        if($num_of_admin_row > 0) {
            if(password_verify($admin_password, $admin_data_fetch['admin_password'])) {
                $_SESSION['admin_name'] = $admin_name;
                echo "<script>alert('Login Successful!');</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } else {
                echo "<script>alert('Invalid Credentails!');</script>";
            }
        }
    }
?>