<?php
    include('../includes/connect.php');

    if(isset($_POST['insert_product'])) {
        $product_title = $_POST['product_title'];
        $description = $_POST['description'];
        $product_keywords = $_POST['product_keywords'];
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_status = 'true';

        // accessing the image
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image3 = $_FILES['product_image3']['name'];

        // accessing image temperory name
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];

        // checking empty conditions
        if($product_title=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_brand=='' or $product_price=='' or $product_image1=='' or $product_image2=='' or $product_image3=='') {
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
            
        } else {
            move_uploaded_file($temp_image1, 'product_images/'.$product_image1);
            move_uploaded_file($temp_image2, 'product_images/'.$product_image2);
            move_uploaded_file($temp_image3, 'product_images/'.$product_image3);

            // insert query
            $insert_products = "INSERT INTO `products`(product_title, `product_description`, `product_keywords`, `category_id`, brand_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title','$description','$product_keywords',$product_category,'$product_brand','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";

            $result_query = mysqli_query($con, $insert_products);

            if($result_query) {
                echo "<script>alert('Successfully inserted the products!');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products - Admin Dashboard</title>

    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Css file link -->
    <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input name="product_title" type="text" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>

            <!-- Description -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input name="description" type="text" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required="required">
            </div>

            <!-- keywords -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_keywords" class="form-label">Product keywords</label>
                <input name="product_keywords" type="text" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

            <!-- categories -->
            <div class="form-outline w-50 mb-3 m-auto">
                <select name="product_category" class="form-select">
                    <option value="">Select a Category</option>

                    <?php
                        $select_query = "SELECT * FROM `categories`";
                        $select_result = mysqli_query($con, $select_query);

                        while($row = mysqli_fetch_assoc($select_result)) {
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";   
                        }
                    ?>
                </select>
            </div>

            <!-- brands -->
            <div class="form-outline w-50 mb-3 m-auto">
                <select name="product_brand" class="form-select">
                    <option value="">Select a Brand</option>
                    
                    <?php
                        $select_query = "SELECT * FROM `brands`";
                        $select_result = mysqli_query($con, $select_query);

                        while($row = mysqli_fetch_assoc($select_result)) {
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";   
                        }
                    ?>
                </select>
            </div>

            <!-- image 1 -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input name="product_image1" type="file" id="product_image1" class="form-control" required="required">
            </div>

            <!-- image 2 -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input name="product_image2" type="file" id="product_image2" class="form-control" required="required">
            </div>

            <!-- image 3 -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input name="product_image3" type="file" id="product_image3" class="form-control" required="required">
            </div>

            <!-- Price -->
            <div class="form-outline w-50 mb-3 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input name="product_price" type="text" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required="required">
            </div>

            <!-- insert button -->
            <div class="form-outline w-50 mb-3 m-auto">
               <input type="submit" name="insert_product" class="btn btn-info rounded-0 text-light mb-3 px-4" value="Insert Product">
            </div>
        </form>
    </div>
</body>
</html>