<?php 
    if(isset($_GET['edit_account'])) {
        $user_session_name = $_SESSION['username'];
        $select_user_data = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
        $user_data_result = mysqli_query($con, $select_user_data);
        $user_data_row = mysqli_fetch_array($user_data_result);
        $user_name = $user_data_row['username'];
        $user_id = $user_data_row['user_id'];
        $user_email = $user_data_row['user_email'];
        $user_address = $user_data_row['user_address'];
        $user_mobile = $user_data_row['user_mobile'];
    }

    if(isset($_POST['user_update'])) {
        $update_id = $user_id;
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_temp_name = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_temp_name, "user_images/$user_image");

        // Update Query
        $update_query = "UPDATE `user_table` SET `username`='$username',`user_email`='$user_email',`user_image`='$user_image',`user_address`='$user_address',`user_mobile`='$user_mobile' WHERE user_id=$update_id";
        $update_query_result = mysqli_query($con, $update_query);

        if($update_query_result) {
            echo "<script>alert('Data updated successfully!');</script>";
            echo "<script>window.open('user_logout.php', '_self')</script>";
        }
    }
?>

<h3 class="mb-4">Edit Account</h3>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username;?>">
    </div>
    <div class="form-outline mb-4">
        <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo  $user_email;?>">
    </div>
    <div class="form-outline mb-4 d-flex w-50 m-auto">
        <input type="file" class="form-control" name="user_image">
        <img class="edit_image" src="user_images/<?php echo $user_image; ?>" alt="">
    </div>
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address;?>">
    </div>
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile;?>">
    </div>

    <input type="submit" value="Update" class="btn btn-info text-white rounded-0 px-5" name="user_update">
</form>