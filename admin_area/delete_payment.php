<?php 
    if(isset($_GET['delete_payment'])) {
        $delete_id = $_GET['delete_payment'];
        $delete_payment = "DELETE FROM `user_payments` WHERE payment_id=$delete_id";
        $result_delete = mysqli_query($con, $delete_payment);

        if($result_delete) {
            echo "<script>alert('Payment Deleted Successfully!')</script>";
            echo "<script>window.open('index.php?payment_list', '_self');</script>";
        }
    }
?>