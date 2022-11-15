<?php 
    if(isset($_GET['edit_category'])) {
        $edit_category = $_GET['edit_category'];
        $select_category = "SELECT * FROM `categories` WHERE category_id=$edit_category";
        $result_category = mysqli_query($con, $select_category);
        $category_row = mysqli_fetch_assoc($result_category);

        $category_title = $category_row['category_title'];
    }

    if(isset($_POST['update_category'])) {
        $category_title = $_POST['category_title'];
        $update_category = "UPDATE `categories` SET `category_title`='$category_title' WHERE `category_id`=$edit_category";
        $result_category = mysqli_query($con, $update_category);

        if($result_category) {
            echo "<script>alert('Category Updated Successfully!')</script>";
        }
    }
?>

<div class="container my-4">
    <h3 class="text-center text-success">Edit Category</h3>

    <form action="" method="post">
        <div class="form-outline text-center w-50 m-auto mt-3">
            <label class="form-label mb-2 fw-bold">Category Title</label>
            <input type="text" class="form-control" value="<?php echo $category_title;?>" name="category_title">
        </div>
        <div class="text-center mt-3">
            <input type="submit" class="btn btn-info rounded-0 px-3" value="Update Category" name="update_category">
        </div>
    </form>
</div>