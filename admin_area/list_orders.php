<div class="container my-5">
    <h3 class="text-center text-success my-4">All Orders</h3>

    <table class="table-bordered table">

            <?php 
                $select_orders = "SELECT * FROM `user_orders`";
                $result_orders = mysqli_query($con, $select_orders);
                $number = 1;
                $num_of_orders = mysqli_num_rows($result_orders);

                if($num_of_orders > 0) {
                    ?>
                    <thead class="bg-info">
            <tr>
                <th>Sl No</th>
                <th>Due Amount</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>

                <tbody class="text-center bg-secondary text-white">


                <?php
                while($row_orders = mysqli_fetch_assoc($result_orders)) {
                    $order_id = $row_orders['order_id'];
                    $amount_due = $row_orders['amount_due'];
                    $invoice_number = $row_orders['invoice_number'];
                    $total_products = $row_orders['total_products'];
                    $order_date = $row_orders['order_date'];
                    $order_status = $row_orders['order_status'];
                    echo "<tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='index.php?delete_order=$order_id' class='text-white'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
                $number++;
                }
            } else {
                echo "<h2 class='text-danger text-center'>No Order Yet!</h2>";
            }
            ?>
        </tbody>
    </table>
</div>