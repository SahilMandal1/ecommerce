<div class="container my-4">
    <h3 class="text-center text-success mb-3">All Categories</h3>

    <table class="table table-bordered">
        <thead class="bg-info">
            <tr>
                <th>Sl No</th>
                <th>Category Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-white text-center">
        <?php
            $number = 1;
            // select categories
            $select_categories = "SELECT * FROM `categories`";
            $result_categories = mysqli_query($con, $select_categories);
            while($row_categories = mysqli_fetch_assoc($result_categories)) {
                $category_title = $row_categories['category_title'];
                $category_id = $row_categories['category_id'];
                echo "<tr>
                <td>$number</td>
                <td>$category_title</td>
                <td><a href='index.php?edit_category=$category_id' class='text-white'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_category=$category_id' class='text-white'><i class='fa-solid fa-trash'></i></a></td>
            </tr>";
            $number++;
            }
        ?>
        </tbody>
    </table>
</div>