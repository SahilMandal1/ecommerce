<?php 
    include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/register.webp" alt="Admin Registration" class="image-fluid registration_image">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required="required">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" id="cpassword" class="form-control" name="cpassword" placeholder="Enter your password" required="required">
                    </div>
                    <div>
                        <input type="submit" value="Register" class="btn btn-info rounded-0 px-4" name="admin_registration">
                        <p class="small mt-2 fw-bold pt-1"> Already have an account? <a href="admin_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
    if(isset($_POST['admin_registration'])) {
        // echo "<script>alert('Admin Registered Successfully')</script>";
        $admin_name = $_POST['username'];
        $admin_email = $_POST['email'];
        $admin_password = $_POST['password'];
        $admin_cpassword = $_POST['cpassword'];
        $admin_encrypt_password = password_hash($admin_password, PASSWORD_DEFAULT);

        // select query
        $select_admin = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name' OR admin_email='$admin_email'";
        $admin_result = mysqli_query($con, $select_admin);
        $num_of_admin_row = mysqli_num_rows($admin_result);
        $fetch_data = mysqli_fetch_assoc($admin_result);

        if($num_of_admin_row > 0) {
            if($admin_email == $fetch_data['admin_email'] && $admin_name == $fetch_data['admin_name']) {
                echo "<script>alert('Admin name and already exists!');</script>";
            }
            else if($admin_name == $fetch_data['admin_name']) {
                echo "<script>alert('Admin name already exists!');</script>";
            } else if($admin_email == $fetch_data['admin_email']) {
                echo "<script>alert('Admin email already exists!');</script>";
            }
        } else if($admin_password != $admin_cpassword) {
            echo "<script>alert('Password do not match!');</script>";
        } else {
            // insert admin
            $insert_admin = "INSERT INTO `admin_table`(`admin_name`, `admin_email`, `admin_password`) VALUES ('$admin_name','$admin_email','$admin_encrypt_password')";
            $insert_admin_result = mysqli_query($con, $insert_admin);

            if($insert_admin_result) {
                echo "<script>alert('Admin Registered Successfully!');</script>";
                echo "<script>window.open('admin_login.php', '_self');;</script>";
            }
        }
        
    }
?>