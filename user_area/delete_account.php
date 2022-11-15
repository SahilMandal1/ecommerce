<h3 class="text-danger">Delete Account</h3>

<form action="" method="post">
    <div class="form-outline">
        <input type="submit" class="form-control w-50 m-auto my-4 bg-danger text-white" name="delete" value="Delete Account">
    </div>
    <div class="form-outline">
        <input type="Submit" class="form-control w-50 m-auto bg-success text-white" name="dont_delete" value ="Don't Delete Account">
    </div>
</form>

<?php 
    $session_username = $_SESSION['username'];
    if(isset($_POST['delete'])) {
        $delete_query = "DELETE FROM `user_table` WHERE username='$session_username'";
        $delete_result = mysqli_query($con, $delete_query);

        if($delete_result) {
            session_destroy();
            echo "<script>alert('Account Deleted Successfully!')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }

    if(isset($_POST['dont_delete'])) {
        echo "<script>window.open('./profile.php', '_self')</script>";
    }
?>