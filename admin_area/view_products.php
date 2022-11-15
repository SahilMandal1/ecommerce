

<h3 class="text-center text-success">All Products</h3>

<table class="table table-bordered mt-4">
    <thead class="bg-info">
        <tr>
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-white text-center">

        <?php
            // Select Query
            $select_products = "SELECT * FROM `products`";
            $result_products = mysqli_query($con, $select_products);
            
            while($row_count=mysqli_fetch_array($result_products)) {
                $product_id = $row_count['product_id'];
                $product_title = $row_count['product_title'];
                $product_image = $row_count['product_image1'];
                $product_price = $row_count['product_price'];
                $status = $row_count['status'];
            ?>

                <tr>
                <td><?php echo $product_id?></td>
                <td><?php echo $product_title?></td>
                <td><img src='./product_images/<?php echo $product_image?>' class='product_image'></td>
                <td><?php echo $product_price?>/-</td>
                <td>
                    <?php 
                        // select query
                        $get_count = "SELECT * FROM `orders_pending` WHERE product_id=$product_id";
                        $result_count = mysqli_query($con, $get_count);
                        $total_sold = mysqli_num_rows($result_count);

                        echo $total_sold;
                    ?>
                </td>
                <td><?php echo $status?></td>
                <td><a href='index.php?edit_products=<?php echo $product_id?>' class='text-white'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_products=<?php echo $product_id?>' class='text-white'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
        ?>
    </tbody>
</table>