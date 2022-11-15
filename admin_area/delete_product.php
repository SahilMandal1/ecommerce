<?php 
    if(isset($_GET['delete_products'])) {
        $get_delete_id = $_GET['delete_products'];
        $delete_product = "DELETE FROM `products` WHERE product_id=$get_delete_id";
        $delete_result = mysqli_query($con, $delete_product);
        if($delete_result) {
            echo "<script>alert('Product Deleted Successfully!')</script>";
            echo "<script>window.open('index.php?view_products', '_self')</script>";
        }
    }
?>