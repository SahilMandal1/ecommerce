<?php 
    if(isset($_GET['delete_brand'])) {
        $delete_brand = $_GET['delete_brand'];
        $delete_query = "DELETE FROM `brands` WHERE brand_id=$delete_brand";
        $delete_result = mysqli_query($con, $delete_query);

        if($delete_result) {
            echo "<script>window.open('index.php?view_brands', '_self')</script>";
        }
    }
?>