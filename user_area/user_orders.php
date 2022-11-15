<?php 
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $fetch_row = mysqli_fetch_assoc($result);
    $get_user_id = $fetch_row['user_id'];
?>

<h3>My Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>Sl No</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody class="bg-secondary text-white">
    <?php 
            $select_user_orders = "SELECT * FROM `user_orders` WHERE user_id=$get_user_id";
            $select_user_orders_result = mysqli_query($con, $select_user_orders);
            $number = 1;
            
            while($row_count = mysqli_fetch_assoc($select_user_orders_result)) {
                $order_id = $row_count['order_id'];
                $amount_due = $row_count['amount_due'];
                $invoice_number = $row_count['invoice_number'];
                $total_products = $row_count['total_products'];
                $order_date = $row_count['order_date'];
                $order_status = $row_count['order_status'];
                if($order_status=='pending') {
                    $order_status = 'Incomplete';
                } else {
                    $order_status = 'Complete';
                }

                echo "<tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
                <?php
                if($order_status=="Complete") {
                    echo "<td>Paid<td>";
                } else {
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-white'>Confirm</a></td></tr>";
                }
                $number++;
            }
        ?>
    </tbody>
</table>