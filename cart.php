<!-- Including connect file -->
<?php 
  include("includes/connect.php");
  include("functions/common_functions.php");
  session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Webiste - Cart details</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

    <style>
        .cart_image {
            height: 80px;
            width: 80px;
            object-fit: contain;
        }
    </style>

</head>
<body>
    
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <img src="images/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php 
          if(!isset($_SESSION['username'])) {
            echo "<li class='nav-item'>
            <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
          </li>";
          } else {
            echo "";
          }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <!-- calling cart function -->
  <?php 
    cart();
  ?>

    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
        <?php 
            if(!isset($_SESSION['username'])) {
              echo "<li class='nav-item'>
              <a href='#' class='nav-link'>Welcome Guest</a>
            </li>";
            } else {
              $user_first_name = explode(" ", $_SESSION['username']);
              echo "<li class='nav-item'>
              <a href='#' class='nav-link'>Welcome ".$user_first_name[0]."</a>
            </li>";
            }
          ?>
          <?php 
            if(!isset($_SESSION['username'])) {
              echo "<li class='nav-item'>
              <a href='user_area/user_login.php' class='nav-link'>Login</a>
            </li>";
            } else {
              echo "<li class='nav-item'>
              <a href='user_area/user_logout.php' class='nav-link'>Logout</a>
            </li>";
            }
          ?>
        </ul>
    </nav>

    <!-- Third Child -->
    <div class="bg-light">
      <h3 class="text-center">Hidden Store</h3>
      <p class="text-center">Communications is at the heart of e-commerce and community</p>
    </div>

    <!-- fourth child -->
    <div class="container">
        <div class="row">
          <form action="" method="post">
            <table class="table table-bordered text-center">
                    <!-- php code to display dynamic data -->
                    <?php   
                        global $con;
                        $ip = getIPAddress();
                        $total_price = 0;
                        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                        $result_query = mysqli_query($con, $select_query);
                        $num_of_rows = mysqli_num_rows($result_query);

                        if($num_of_rows > 0) {
                          echo "<thead>
                          <tr>
                              <th>Product Title</th>
                              <th>Product Image</th>
                              <th>Quantity</th>
                              <th>Total Price</th>
                              <th>Remove</th>
                              <th colspan='2'>Operations</th>
                          </tr>
                      </thead>";
                        while($row=mysqli_fetch_array($result_query)) {
                          $product_id = $row['product_id'];
                          $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
                          $result_product = mysqli_query($con, $select_product);
                  
                          while($row_product_price=mysqli_fetch_array($result_product)) {
                            $product_price = array($row_product_price['product_price']);
                            $price_table = $row_product_price['product_price'];
                            $product_title = $row_product_price['product_title'];
                            $product_image1 = $row_product_price['product_image1'];
                            $total_price += array_sum($product_price);
                        ?>
                        <tbody>
                    <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="admin_area/product_images/<?php echo $product_image1 ?>" class="cart_image" alt="<?php echo $product_title ?>"></td>
                    <td><input type="text" name="qty" id="" class="w-50"></td>
                    <?php
                      $ip = getIPAddress();
                      if(isset($_POST['update_quantity'])) {
                        $quantity = $_POST['qty'];
                        $update_query = "UPDATE `cart_details` SET `quantity`=$quantity WHERE ip_address='$ip'";
                        $update_query_result = mysqli_query($con, $update_query);
                        $total_price = $total_price*$quantity;
                      }
                    ?>
                    <td><?php echo $price_table;?>/-</td>
                    <td><input type="checkbox" name="remove_item[]" value="<?php echo $product_id;?>" id=""></td>
                    <td>
                        <input type="submit" value="Update" class="bg-info border-0 py-1 px-3 text-white mx-2" name="update_quantity">
                        <input type="submit" value="Remove" class="bg-info border-0 py-1 px-3 text-white" name="remove_product">
                    </td>
                    </tr>

                    <?php
                    }
                }} else {
                  echo "<h2 class='text-danger text-center'>Cart is empty!</h2>";
                }
            ?>
                </tbody>
            </table>

            <!-- subtotal -->
            <div class="d-flex mb-5">
              <?php 
                 $ip = getIPAddress();
                 $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
                 $result_query = mysqli_query($con, $select_query);
                 $num_of_rows = mysqli_num_rows($result_query);

                if($num_of_rows > 0) {
                  echo "<h4 class='px-3'>Subtotal: <strong class='text-info'>$total_price/-</strong></h4>
                  <input type='submit' class='mx-2 btn btn-info rounded-0 text-white px-3' value='Continue Shopping' name='continue_shopping'>
                  <button class='px-3 btn btn-secondary rounded-0 text-white'><a class='text-white text-decoration-none' href='checkout.php'>Checkout</a></button>";
                } else {
                  echo "<input type='submit' class='mx-2 btn btn-info rounded-0 text-white px-3' value='Continue Shopping' name='continue_shopping'>";
                }

                if(isset($_POST['continue_shopping'])) {
                  echo "<script>window.open('index.php', '_self')</script>";
                }
              ?>
            </div>
          </div>
        </div>
      </form>

      <!-- remove cart item function -->
      <?php 
        function remove_cart_item() {
          global $con;
          if(isset($_POST['remove_product'])) {
            foreach($_POST['remove_item'] as $remove_id) {
              $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id";
              $delete_query_result = mysqli_query($con, $delete_query);

              if($delete_query_result) {
                echo "<script>window.open('cart.php','_self');</script>";
              }
            }
          }
        }

        // calling remove cart function:
        remove_cart_item();
      ?>

    
        <!-- last child -->
    <!-- includes footer file -->
    <?php include('./includes/footer.php'); ?>

    </div>

    <!-- boostrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>