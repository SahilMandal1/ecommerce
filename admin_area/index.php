<?php 
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Css file link -->
    <link rel="stylesheet" href="../style.css">

</head>
<body>
    

    <!-- Navbar -->
    <div class="container-fluid p-0">
        <!-- First Child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome 
                                <?php 
                                    if(isset($_SESSION['admin_name'])) {
                                        echo $_SESSION['admin_name'];
                                    } else {
                                        echo "Guest";
                                    }
                                ?>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- Second child -->
        <div class="bg-light p-2">
            <h3 class="text-center">Manage Details</h3>
        </div>

        <!-- Third Child -->
        <div class="row">
            <div class="col-md-12 bg-secondary d-flex align-items-center p-1">
                <div class="px-5">
                    <a href="#"><img src="../images/profile.jpg" alt="" class="admin_image"></a>
                    <p class="text-center text-light">
                        <?php 
                            if(isset($_SESSION['admin_name'])) {
                                echo $_SESSION['admin_name'];
                            } else {
                                echo "Admin Name";
                            }
                        ?>
                    </p>
                </div>

                <div class="button text-center px-5">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info py-2 px-3">Insert Products</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info py-2 px-3">View Products</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info py-2 px-3">Insert Categories</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-info py-2 px-3">View Categories</a></button>
                    <button><a href="index.php?insert_brands" class="nav-link text-light bg-info py-2 px-3">Insert Brands</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-info py-2 px-3">View Brands</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-info py-2 px-3">All Orders</a></button>
                    <button><a href="index.php?payment_list" class="nav-link text-light bg-info py-2 px-3">All Payments</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-info py-2 px-3">List Users</a></button>
                    <button><a href="admin_logout.php" class="nav-link text-light bg-info py-2 px-3">Logout</a></button>
                </div>
            </div>
        </div>

        <!-- Fourth Child -->
        <div class="container my-3">
            <?php 
                if(isset($_GET['insert_category'])) {
                    include 'insert_categories.php';
                }
                if(isset($_GET['insert_brands'])) {
                    include('insert_brands.php');
                }
                if(isset($_GET['view_products'])) {
                    include('view_products.php');
                }
                if(isset($_GET['edit_products'])) {
                    include('edit_products.php');
                }
                if(isset($_GET['delete_products'])) {
                    include('delete_product.php');
                }
                if(isset($_GET['view_categories'])) {
                    include('view_categories.php');
                }
                if(isset($_GET['edit_category'])) {
                    include('edit_category.php');
                }
                if(isset($_GET['delete_category'])) {
                    include('delete_category.php');
                }
                if(isset($_GET['view_brands'])) {
                    include('view_brands.php');
                }
                if(isset($_GET['delete_brand'])) {
                    include('delete_brand.php');
                }
                if(isset($_GET['edit_brand'])) {
                    include('edit_brand.php');
                }
                if(isset($_GET['list_users'])) {
                    include('list_users.php');
                }
                if(isset($_GET['delete_user'])) {
                    include('delete_user.php');
                }
                if(isset($_GET['list_orders'])) {
                    include('list_orders.php');
                }
                if(isset($_GET['delete_order'])) {
                    include('delete_order.php');
                }
                if(isset($_GET['payment_list'])) {
                    include('payment_list.php');
                }
                if(isset($_GET['delete_payment'])) {
                    include('delete_payment.php');   
                }
            ?>
        </div>

         <!-- last child -->
        <div class="bg-info p-3 text-center footer w-100">
            <p>All rights reserved ©- Designed by Sahil Mandal - 2022</p>
        </div>
    </div>




    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>