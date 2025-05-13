<?php

include_once(__DIR__ . '/../includes/connect.php');


/* Return total number of items in the cart for the current user */
function getCartItemCount() {
    global $con;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
    $query = "SELECT SUM(quantity) AS total FROM card_details WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return ($row['total']) ? $row['total'] : 0;
}

/* Return HTML for cart dropdown items with product images */
function getCartItems() {
    global $con;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
    $query = "SELECT cd.quantity, c.product_title, c.product_price, c.product_image 
              FROM card_details cd 
              LEFT JOIN categories c ON cd.product_id = c.product_id 
              WHERE cd.user_id = '$user_id'";
    $result = mysqli_query($con, $query);
    $html = "";
    if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_assoc($result)){
              $product_title = $row['product_title'];
              $product_price = $row['product_price'];
              $quantity = $row['quantity'];
              $product_image = $row['product_image'];
              $image_path = 'Images/' . $product_image;
              if(!file_exists($image_path) || empty($product_image)){
                  $image_path = 'Images/default.jpg';
              }
              $html .= "<li class='dropdown-item'>
                          <img src='$image_path' style='width:50px; height:50px; object-fit:cover; margin-right:5px;' alt='$product_title'> 
                          $product_title (x$quantity) - \$$product_price
                        </li>";
         }
         $html .= "<li><hr class='dropdown-divider'></li>";
         $html .= "<li><a class='dropdown-item text-center' href='cart.php'>View Cart</a></li>";
    } else {
         $html .= "<li class='dropdown-item'>Cart is empty</li>";
    }
    return $html;
}

/* Fetch products from the categories table and return product cards as HTML.
   $limit controls the number of products (e.g. 4 for home page, 9 for shop page).
   For home page, if exactly 4 products are returned, the last product is centered.
*/
function getProducts($search_query = '', $limit = 4) {
    global $con;
    if (!empty($search_query)) {
        $query = "SELECT * FROM categories 
                  WHERE product_title LIKE '%$search_query%' OR product_description LIKE '%$search_query%'";
    } else {
        $query = "SELECT * FROM categories ORDER BY RAND() LIMIT $limit";
    }
    $result = mysqli_query($con, $query);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    $total = count($rows);
    $output = "";
    $count = 0;
    // Category mapping arrays for "View more" links
    $shirt_ids = array(7,4,8,6,2);
    $tracksuit_ids = array(1,3);
    $jacket_ids = array(10,5,9);
    
    foreach ($rows as $row) {
        $count++;
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
        
        $image_path = 'Images/' . $product_image;
        if (!file_exists($image_path) || empty($product_image)) {
            $image_path = 'Images/default.jpg';
        }
        
        if (in_array($product_id, $shirt_ids)) {
            $view_more_link = "product_details.php?category=shirt";
        } elseif (in_array($product_id, $tracksuit_ids)) {
            $view_more_link = "product_details.php?category=tracksuit";
        } elseif (in_array($product_id, $jacket_ids)) {
            $view_more_link = "product_details.php?category=jacket";
        } else {
            $view_more_link = "product_details.php?product_id=" . $product_id;
        }
        
        $col_class = "col-md-4 mb-4";
        if($total == 4 && $count == 4){
            $col_class = "col-md-4 offset-md-4 mb-4";
        }
        
        $output .= "<div class='$col_class'>
                        <div class='card h-100 shadow-lg'>
                            <img src='$image_path' class='card-img-top img-fluid' alt='$product_title' style='height:550px; width:100%; object-fit:cover;'>
                            <div class='card-body text-center'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'><strong>Price: \$$product_price</strong></p>
                                <a href='add_to_cart.php?product_id={$product_id}' class='btn btn-info'>Add to Cart</a>
                                <a href='$view_more_link' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
    }
    
    if($total == 0){
        $output .= !empty($search_query)
                    ? "<h2 class='text-center text-danger'>No results found for '$search_query'</h2>"
                    : "<h2 class='text-center text-danger'>No products available.</h2>";
    }
    return $output;
}
?>
