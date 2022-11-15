<?php 
    if(isset($_GET['delete_category'])) {
        $delete_category = $_GET['delete_category'];
        $delete_category = "DELETE FROM `categories` WHERE category_id=$delete_category";
        $delete_result = mysqli_query($con, $delete_category);

        if($delete_result) {
            echo "<script>alert('Category Deleted Successfully!')</script>";
            echo "<script>window.open('index.php?view_categories', '_self')</script>";
        }
    }
?>