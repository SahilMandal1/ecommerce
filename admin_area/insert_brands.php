<?php 

    include('../includes/connect.php');

    if(isset($_POST['insert_brands'])) {
        $brand_title = $_POST['brand_title'];

        // Select data from the database
        $select_query = "SELECT * FROM `brands` WHERE brand_title= '$brand_title'";
        $select_result = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($select_result);

        if($number>0) {
            echo "<script>alert('This brand is already present inside the database!');</script>";
        }
        else {
            $insert_query = "INSERT INTO `brands`(brand_title) VALUES ('$brand_title')";
            $result = mysqli_query($con, $insert_query);

            if($result) {
                echo "<script>alert('Brand has been inserted successfully!');</script>";
            }
        }
    }

?>

<h3 class="text-center">Insert Brands</h3>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-sharp fa-solid fa-square"></i></span>
        <input required type="text" class="form-control" placeholder="Insert brands" aria-label="brands" aria-describedby="basic-addon1" name="brand_title">
    </div>

    <div class="input-group w-10 mb-2">
        <input type="submit" class="btn btn-info rounded-0 bg-info my-2  text-light" value="Insert Brands" name="insert_brands">
    </div>
</form>