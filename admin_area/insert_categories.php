<?php 

    include('../includes/connect.php');

    if(isset($_POST['insert_cat'])) {
        $category_title = $_POST['cat_title'];

        // Select data from the database
        $select_query = "SELECT * FROM `categories` WHERE category_title= '$category_title'";
        $select_result = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($select_result);

        if($number>0) {
            echo "<script>alert('This category is already present inside the database!');</script>";
        }
        else {
            $insert_query = "INSERT INTO `categories`(category_title) VALUES ('$category_title')";
            $result = mysqli_query($con, $insert_query);

            if($result) {
                echo "<script>alert('Category has been inserted successfully!');</script>";
            }
        }
    }

?>

<h3 class="text-center">Insert Categories</h3>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-sharp fa-solid fa-square"></i></span>
        <input required type="text" class="form-control" placeholder="Insert categories" aria-label="Categories" aria-describedby="basic-addon1" name="cat_title">
    </div>

    <div class="input-group w-10 mb-2">
        <input type="submit" class="btn btn-info rounded-0 bg-info my-2  text-light" value="Insert Categories" name="insert_cat">
    </div>
</form>