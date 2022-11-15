<?php 
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        
        // getting total items and total price of all items
        $ip_address = getIPAddress();
        $total_price = 0;
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip_address'";
        $result_query = mysqli_query($con, $select_query);
        $count_number_products = mysqli_num_rows($result_query);
        $invoice_number = mt_rand();
        $status = "pending";
        
        while($row_price = mysqli_fetch_array($result_query)) {
            $product_id = $row_price['product_id'];
            $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
            $select_result_product = mysqli_query($con, $select_product);
            while($row_product_price = mysqli_fetch_array($select_result_product)) {
                $total_price += $row_product_price['product_price'];
            }
        }
    }

    // getting quantity from cart
    $get_cart = "SELECT * FROM `cart_details`";
    $get_cart_result = mysqli_query($con, $get_cart);
    $get_cart_item = mysqli_fetch_array($get_cart_result);
    $quantity = $get_cart_item['quantity'];

    if($quantity == 0) {
        $quantity = 1;
        $subtotal = $total_price;
    } else {
        $quantity = $quantity;
        $subtotal = $quantity * $total_price;
    }

    // insert the orders in user_order table
    $insert_orders = "INSERT INTO `user_orders`(`user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES ($user_id,$subtotal,$invoice_number,$count_number_products,NOW(),'$status')";
    $result_query = mysqli_query($con, $insert_orders);

    if($result_query) {
        echo "<script>alert('Order inserted successfully!')</script>";
        echo "<script>window.open('profile.php', '_self')</script>";
    }

    // Orders Pending
    $insert_pending_orders = "INSERT INTO `orders_pending`(`user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES ($user_id,$invoice_number,$product_id,$quantity,'$status')";
    $insert_pending_orders_result = mysqli_query($con, $insert_pending_orders);

    // delete item from cart
    $delete_cart = "DELETE FROM `cart_details` WHERE ip_address='$ip_address'";
    $delete_cart_result = mysqli_query($con, $delete_cart);
    
?>