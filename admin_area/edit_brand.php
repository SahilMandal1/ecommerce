<?php 
    if(isset($_GET['edit_brand'])) {
        $edit_brand = $_GET['edit_brand'];
        $select_brand = "SELECT * FROM `brands` WHERE brand_id=$edit_brand";
        $result_brand = mysqli_query($con, $select_brand);
        $brand_row = mysqli_fetch_assoc($result_brand);

        $brand_title = $brand_row['brand_title'];
    }

    if(isset($_POST['update_brand'])) {
        $brand_title = $_POST['brand_title'];
        $update_brand = "UPDATE `brands` SET `brand_title`='$brand_title' WHERE `brand_id`=$edit_brand";
        $result_brand = mysqli_query($con, $update_brand);

        if($result_brand) {
            echo "<script>alert('Brand Updated Successfully!')</script>";
        }
    }
?>

<div class="container my-4">
    <h3 class="text-center text-success">Edit brand</h3>

    <form action="" method="post">
        <div class="form-outline text-center w-50 m-auto mt-3">
            <label class="form-label mb-2 fw-bold">Brand Title</label>
            <input type="text" class="form-control" value="<?php echo $brand_title;?>" name="brand_title">
        </div>
        <div class="text-center mt-3">
            <input type="submit" class="btn btn-info rounded-0 px-3" value="Update Brand" name="update_brand">
        </div>
    </form>
</div>