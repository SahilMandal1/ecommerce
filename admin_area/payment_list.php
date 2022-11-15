<div class="container my-5">
    <h3 class="text-center text-success mb-4">All Payments</h3>

    <table class="table-bordered table">
        <?php 
            $select_payment = "SELECT * FROM `user_payments`";
            $result_payment = mysqli_query($con, $select_payment);
            $num_of_payments = mysqli_num_rows($result_payment);
            $number = 1;

            if($num_of_payments > 0) {
            ?>
                <thead class="bg-info">
            <tr>
                <th>Sl No</th>
                <th>Invoice No</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Order Date</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody class="bg-secondary text-center text-white">
                <?php 
                    while($row_payment = mysqli_fetch_assoc($result_payment)) {
                        $payment_id = $row_payment['payment_id'];
                        $invoice_number = $row_payment['invoice_number'];
                        $amount = $row_payment['amount'];
                        $payment_mode = $row_payment['payment_mode'];
                        $payment_date = $row_payment['date'];
                    ?>
                    <tr>
                        <td><?php echo $number;?></td>
                        <td><?php echo $invoice_number;?></td>
                        <td><?php echo $amount;?></td>
                        <td><?php echo $payment_mode?></td>
                        <td><?php echo $payment_date;?></td>
                        <td><a class="text-white" href="index.php?delete_payment=<?php echo $payment_id;?>"><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
                    <?php
                    $number++;
                    } 
                ?>
        </tbody>
            <?php
            }
        ?>
    </table>
</div>