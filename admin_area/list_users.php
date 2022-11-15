<div class="container my-5">
    <h3 class="text-success text-center mb-4">All Users List</h3>

    <table class="table table-bordered">
        <thead class="bg-info">
            <tr>
                <th>Sl No</th>
                <th>Username</th>
                <th>User Email</th>
                <th>User Image</th>
                <th>User Address</th>
                <th>User Mobile</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody class="bg-secondary text-white text-center">
            <?php 
                $select_users = "SELECT * FROM `user_table`";
                $users_result = mysqli_query($con, $select_users);
                $number = 1;

                while($users_row = mysqli_fetch_assoc($users_result)) {
                    $user_id = $users_row['user_id'];
                    $username = $users_row['username'];
                    $user_email = $users_row['user_email'];
                    $user_image = $users_row['user_image'];
                    $user_address = $users_row['user_address'];
                    $user_mobile = $users_row['user_mobile'];

                    echo "<tr>
                    <td>$number</td>
                    <td>$username</td>
                    <td>$user_email</td>
                    <td><img src='../user_area/user_images/$user_image' alt='' class='product_image'></td>
                    <td>$user_address</td>
                    <td>$user_mobile</td>
                    <td><a href='index.php?delete_user=$user_id' class='text-white'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";

                $number++;
                }
            ?>
            
        </tbody>
    </table>
</div>