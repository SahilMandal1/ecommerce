<?php 
    if(isset($_GET['delete_user'])) {
        $delete_id = $_GET['delete_user'];
        
        $delete_user = "DELETE FROM `user_table` WHERE user_id=$delete_id";
        $delete_result = mysqli_query($con, $delete_user);

        if($delete_result) {
            echo "<script>alert('User Deleted Successfully!')</script>";
            echo "<script>window.open('index.php?list_users', '_self')</script>";
        }
    }
?>