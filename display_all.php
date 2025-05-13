<?php

include('./includes/connect.php');
include('./functions/common_function.php');

// You can add a search query if desired:
$search_query = isset($_GET['search_data']) ? mysqli_real_escape_string($con, $_GET['search_data']) : '';
// For simplicity, we'll ignore search here and select nine random products.
$query = "SELECT * FROM categories ORDER BY RAND() LIMIT 9";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Temps Clothing - Shop</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <!-- Include common header (navbar with cart dropdown, etc.) -->
  <?php include('header.php'); ?>
  
  
  
  <!-- Flash Message -->
  <?php
  if (isset($_SESSION['cart_message'])) {
      echo "<div class='container mt-4'><div class='alert alert-success text-center'>" . $_SESSION['cart_message'] . "</div></div>";
      unset($_SESSION['cart_message']);
  }
  ?>
  
  <!-- Products Section (9 products for Shop) -->
  <div class="container mt-4">
    <div class="row">
      <?php
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_assoc($result)){
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_description = $row['product_description'];
              $product_price = $row['product_price'];
              $product_image = $row['product_image'];
              $image_path = 'Images/' . $product_image;
              if(!file_exists($image_path) || empty($product_image)){
                  $image_path = 'Images/default.jpg';
              }
              echo "<div class='col-md-4 mb-4'>
                      <div class='card h-100 shadow-lg'>
                        <img src='$image_path' class='card-img-top img-fluid' alt='$product_title' style='height:550px; width:100%; object-fit:cover;'>
                        <div class='card-body text-center'>
                          <h5 class='card-title'>$product_title</h5>
                          <p class='card-text'>$product_description</p>
                          <p class='text-muted small'>All products are medium sized</p>
                          <p class='card-text'><strong>Price: \$$product_price</strong></p>
                          <a href='add_to_cart.php?product_id={$product_id}' class='btn btn-info'>Add to Cart</a>
                        </div>
                      </div>
                    </div>";
          }
      } else {
          echo "<h2 class='text-center text-danger'>No products available.</h2>";
      }
      ?>
    </div>
  </div>
  
  <!-- Include common footer -->
  <?php include("includes/footer.php"); ?>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
