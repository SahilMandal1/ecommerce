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
    <title>Ecommerce Webiste using PHP and MySQL</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

    <style>
      body {
        overflow-x:hidden;
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
            echo "<a class='nav-link' href='./user_area/profile.php'>My Account</a>";
          }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="get" action="search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
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

    <!-- Fourth Child -->
    <div class="row px-3">
      <div class="col-md-10">
        <!-- Products -->
        <div class="row">

          <!-- fetching product -->
          <?php 
            // calling function
            getproducts();
            get_unique_categories();
            get_unique_brands();
            // $ip = getIPAddress();  
            // echo 'User Real IP Address - '.$ip;  
          ?>

          <!-- <div class="col-md-4 mb-2">
          <div class="card">
            <img src="images/apple.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-info">Add to cart</a>
              <a href="#" class="btn btn-secondary">View more</a>
            </div>
          </div>
          </div> -->
          <!-- column end -->
        </div>
        <!-- row end -->
      </div>
      <div class="col-md-2 bg-secondary p-0">
        <!-- Sidenav -->
        <!-- Brands to be displayed -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
          </li>

          <?php
            getbrands();
          ?>
        </ul>

        <!-- Categories to be displayed -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
          </li>

          <?php
            getcategories();
          ?>
        </ul>
      </div>
    </div>


    </div>








    <!-- last child -->
    <!-- includes footer file -->
    <?php include('./includes/footer.php'); ?>

    <!-- boostrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>