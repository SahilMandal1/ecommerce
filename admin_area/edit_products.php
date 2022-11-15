<?php 
    if(isset($_GET['edit_products'])) {
        $get_product_id = $_GET['edit_products'];

        // Select query;
        $select_product = "SELECT * FROM `products` WHERE product_id=$get_product_id";
        $result_product = mysqli_query($con, $select_product);
        $product_details = mysqli_fetch_array($result_product);

        $product_title = $product_details['product_title'];
        $product_description = $product_details['product_description'];
        $product_keywords = $product_details['product_keywords'];
        $product_image1 = $product_details['product_image1'];
        $product_image2 = $product_details['product_image2'];
        $product_image3 = $product_details['product_image3'];
        $product_price = $product_details['product_price'];
        $category_id = $product_details['category_id'];
        $brand_id = $product_details['brand_id'];
   }
?>

<div class="container mt-4">
    <h2 class="text-center">Edit Products</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" name="product_title" id="product_title" value="<?php echo $product_title?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Product Description</label>
            <input type="text" class="form-control" name="product_desc" id="product_desc" value="<?php echo $product_description?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" class="form-control" name="product_keywords" id="product_keywords" value="<?php echo $product_keywords?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" id="product_category" class="form-select">
                <?php 
                     // Fetch category name
                    $select_category = "SELECT * FROM `categories`";
                    $result_category = mysqli_query($con, $select_category);

                    while($category_row = mysqli_fetch_assoc($result_category)) {
                        $category_title = $category_row['category_title'];
                        $category_id = $category_row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brands" class="form-label">Product Brand</label>
            <select name="product_brands" id="product_brands" class="form-select">
                <?php 
                    // Fetch brand name
                    $select_brand = "SELECT* FROM `brands`";
                    $result_brand = mysqli_query($con, $select_brand);                    
                    while($brand_row = mysqli_fetch_assoc($result_brand)) {
                        $brand_id = $brand_row['brand_id'];
                        $brand_title = $brand_row['brand_title'];

                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image1</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_image1" id="product_image1">
                <img src="./product_images/<?php echo $product_image1?>" alt="" class="product_image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image2</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_image2" id="product_image2">
                <img src="./product_images/<?php echo $product_image2?>" alt="" class="product_image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image3</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_image3" id="product_image3">
                <img src="./product_images/<?php echo $product_image3?>" alt="" class="product_image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" name="product_price" id="product_price" value="<?php echo $product_price?>">
        </div>
        <div class="text-center">
            <input type="submit" value="Update Product" name="edit_product" class="btn btn-info rounded-0 px-3">
        </div>
   </form>
</div>

<?php 
    if(isset($_POST['edit_product'])) {
        $product_title = $_POST['product_title'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $product_category = $_POST['product_category'];
        $product_brands = $_POST['product_brands'];
        $product_price = $_POST['product_price'];
        $product_image1_name = $_FILES['product_image1']['name'];
        $product_image2_name = $_FILES['product_image2']['name'];
        $product_image3_name = $_FILES['product_image3']['name']; 

        $product_image1_temp = $_FILES['product_image1']['tmp_name'];
        $product_image2_temp = $_FILES['product_image2']['tmp_name'];
        $product_image3_temp = $_FILES['product_image3']['tmp_name'];

        // checking field empty or not
        if($product_title=='' or $product_desc=='' or $product_keywords=='' or $product_category=='' or $product_brands=='' or $product_price=='' or $product_image1_name=='' or $product_image2_name=='' or $product_image3_name=='') {
            echo "<script>alert('Please fill all the fields')</script>";
        } else {
            move_uploaded_file($product_image1_temp, "./product_images/$product_image1_name");
            move_uploaded_file($product_image2_temp, "./product_images/$product_image2_name");
            move_uploaded_file($product_image3_temp, "./product_images/$product_image3_name");

            // Update query
            $update_query = "UPDATE `products` SET `product_title`='$product_title',`product_description`='$product_desc',`product_keywords`='$product_keywords',`category_id`='$product_category',`brand_id`='$product_brands',`product_image1`='$product_image1_name',`product_image2`='$product_image2_name',`product_image3`='$product_image3_name',`product_price`='$product_price',`date`=NOW() WHERE product_id=$get_product_id";

            $update_result = mysqli_query($con, $update_query);

            if($update_result) {
                echo "<script>alert('Product Updated Successfully!')</script>";
                echo "<script>window.open('index.php?view_products', '_self');</script>";
            }
        }
    }
?>