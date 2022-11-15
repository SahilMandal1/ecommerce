<div class="container my-4">
    <h3 class="text-center text-success mb-3">All Brands</h3>

    <table class="table table-bordered">
        <thead class="bg-info">
            <tr>
                <th>Sl No</th>
                <th>Brand Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-white text-center">
        <?php
            $number = 1;
            // select categories
            $select_brands = "SELECT * FROM `brands`";
            $result_brands = mysqli_query($con, $select_brands);
            while($row_brands = mysqli_fetch_assoc($result_brands)) {
                $brand_title = $row_brands['brand_title'];
                $brand_id = $row_brands['brand_id'];
                echo "<tr>
                <td>$number</td>
                <td>$brand_title</td>
                <td><a href='index.php?edit_brand=$brand_id' class='text-white'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_brand=$brand_id' class='text-white' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
            </tr>";
            $number++;
            }
        ?>
        </tbody>
      </table>
  </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h5>Are you sure you want to delete this?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="index.php?view_brands" class="text-decoration-none text-white">No</a></button>
        <button type="button" class="btn btn-primary"><a  href='index.php?delete_brand=<?php echo $brand_id?>' class='text-white text-decoration-none' data-bs-toggle='modal' data-bs-target='#exampleModal'>Yes</a></button>
      </div>
    </div>
  </div>
</div>