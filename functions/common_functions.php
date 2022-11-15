<?php 

    // including connect file
    // include('./includes/connect.php');

    function getproducts() {
        global $con;

        if(!isset($_GET['category'])) {
          if(!isset($_GET['brand'])) {
        $select_query = "SELECT * FROM `products` order by rand() limit 0,4";
            $result_query = mysqli_query($con, $select_query);
            

           while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];


            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
              <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price/-</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='products_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>
            </div>";
           }
          }
        }
    }


    // getting unique categories
    function get_unique_categories() {
      global $con;

        if(isset($_GET['category'])) {
          $category_id = $_GET['category'];
          $select_query = "SELECT * FROM `products` where category_id=$category_id ";
          $result_query = mysqli_query($con, $select_query);
          $num_of_rows = mysqli_num_rows($result_query);

          if($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
          }
            

           while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];


            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
              <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price/-</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='products_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>
            </div>";
           }
          }
    }

    // getting unique categories
    function get_unique_brands() {
      global $con;

        if(isset($_GET['brand'])) {
          $brand_id = $_GET['brand'];
          $select_query = "SELECT * FROM `products` where brand_id=$brand_id ";
          $result_query = mysqli_query($con, $select_query);
          $num_of_rows = mysqli_num_rows($result_query);

          if($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>This brand is not available for service</h2>";
          }
            

           while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];


            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
              <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price/-</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='products_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>
            </div>";
           }
          }
    }


    // displaying brands in sidenav
    function getbrands() {
        global $con;

        $selcet_brands = "SELECT * FROM `brands`";
            $selcet_result = mysqli_query($con, $selcet_brands);
            // $row_data = mysqli_fetch_assoc($selcet_result);
            // echo $row_data['brand_title'];
            while($row_data = mysqli_fetch_assoc($selcet_result)) {
              $brand_title = $row_data['brand_title'];
              $brand_id = $row_data['brand_id'];
              echo "<li class='nav-item'>
              <a href='index.php?brand=$brand_id' class='nav-link text-light'>{$brand_title}</a>
            </li>";
            }
    }

    // displaying categories in sidenav
    function getcategories() {
        global $con;

        $selcet_categories = "SELECT * FROM `categories`";
            $selcet_result = mysqli_query($con, $selcet_categories);
            // $row_data = mysqli_fetch_assoc($selcet_result);
            // echo $row_data['brand_title'];
            while($row_data = mysqli_fetch_assoc($selcet_result)) {
              $category_title = $row_data['category_title'];
              $category_id = $row_data['category_id'];
              echo "<li class='nav-item'>
              <a href='index.php?category=$category_id' class='nav-link text-light'>{$category_title}</a>
            </li>";
            }
    }

    // Searching product function
    function search_product() {
          global $con;
          if(isset($_GET['search_data_product'])) 
          {
          $search_data_value=$_GET['search_data'];
          $search_query = "SELECT * FROM `products` where 	product_keywords like '%search_data_value%'";
          $result_query = mysqli_query($con, $search_query);
            

           while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];


            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
              <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price/-</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='products_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>
            </div>";
           }
          }
        }

        // getting all products
        function get_all_products() {
          global $con;

        if(!isset($_GET['category'])) {
          if(!isset($_GET['brand'])) {
        $select_query = "SELECT * FROM `products` order by rand()";
            $result_query = mysqli_query($con, $select_query);
            

           while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];


            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
              <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price/-</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='products_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
              </div>
            </div>
            </div>";
           }
          }
        }
        }

        // View details
        function view_details() {
          global $con;
        
        if(isset($_GET['product_id'])) {
        if(!isset($_GET['category'])) {
          if(!isset($_GET['brand'])) {
            $product_id = $_GET['product_id'];
        $select_query = "SELECT * FROM `products` where product_id=$product_id";
            $result_query = mysqli_query($con, $select_query);
            

           while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];
            $product_image2 = $row['product_image2'];
            $product_image3 = $row['product_image3'];
            $product_price = $row['product_price'];


            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
              <img src='admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
              <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <p class='card-text'>Price: $product_price/-</p>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                <a href='index.php' class='btn btn-secondary'>Go home</a>
              </div>
            </div>
            </div> 
            <div class='col-md-8'>
                <!-- related images -->
                <div class='row'>
                    <div class='col-md-12'>
                        <h4 class='text-center text-info'>Related Products</h4>
                    </div>

                    <div class='col-md-6'>
                        <img src='admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                    </div>

                    <div class='col-md-6'>
                        <img src='admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
                    </div>
                </div>
            </div>";
           }
          }
        }
        }
      }

      // getting ip address
      function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  


    // Function cart
    function cart() {
      if(isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip' AND product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows>0) {
          echo "<script>alert('This item is already present inside cart')</script>";
          echo "<script>window.open('index.php', '_self')</script>";
        } else {
          $insert_query = "INSERT INTO `cart_details`(`product_id`, `ip_address`, `quantity`) VALUES ($get_product_id,'$ip',0)";
          $result_query = mysqli_query($con, $insert_query);

          if($result_query) {
            echo "<script>alert('Item is added to cart!');</script>";
            echo "<script>window.open('index.php', '_self')</script>";
          }
        }
      }
    }


    // function to get cart item numbers
    function cart_item() {
      if(isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $cart_items = mysqli_num_rows($result_query);
      } else {
        global $con;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $cart_items = mysqli_num_rows($result_query);
      }

      echo $cart_items;
    }


    // Total price function
    function total_cart_price() {
      global $con;
      $ip = getIPAddress();
      $total_price = 0;
      $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
      $result_query = mysqli_query($con, $select_query);
      while($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
        $result_product = mysqli_query($con, $select_product);

        while($row_product_price=mysqli_fetch_array($result_product)) {
          $product_price = array($row_product_price['product_price']);
          $total_price += array_sum($product_price);
        }
      }

      echo $total_price;
    }


    // Get user order details
    function get_user_order_details() {
      global $con;
      $username = $_SESSION['username'];
      $get_details = "SELECT * FROM `user_table` WHERE username='$username'";
      $get_details_result = mysqli_query($con, $get_details);

      if($row_data = mysqli_fetch_array($get_details_result)){
        $user_id = $row_data['user_id'];
        if(!isset($_GET['edit_account'])) {
          if(!isset($_GET['my_orders'])) {
            if(!isset($_GET['delete_account'])) {
              $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='pending'";
              $get_orders_result = mysqli_query($con, $get_orders);
              $get_orders_row_count = mysqli_num_rows($get_orders_result);
              
              if($get_orders_row_count > 0) {
                echo "<h3 class='text-success'>You have <span class='text-danger'>$get_orders_row_count</span> pending orders</h3>
                <a class='text-dark' href='profile.php?my_orders'>Order Details</a>";
              } else {
                echo "<h3 class='text-success'>You have <span class='text-danger'>0</span> pending orders</h3>
                <a class='text-dark' href='../index.php'>Explore Products</a>";
              }
            }
          }
        }
      }
    }

?>