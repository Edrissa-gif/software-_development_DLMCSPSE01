<?php

include('./includes/connect.php');
include('./functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php 
      if(isset($_GET['category'])){
          $cat = strtolower($_GET['category']);
          if($cat == 'shirt'){
              echo "Shirts - Temps Clothing";
          } elseif($cat == 'tracksuit'){
              echo "Tracksuits - Temps Clothing";
          } elseif($cat == 'jacket'){
              echo "Jackets - Temps Clothing";
          } else {
              echo "Products - Temps Clothing";
          }
      } elseif(isset($_GET['product_id'])){
          echo "Product Details - Temps Clothing";
      } else {
          echo "Products - Temps Clothing";
      }
    ?>
  </title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
</head>
<body>
  <!-- Include common header (navbar, cart dropdown, header section) -->
  <?php include('header.php'); ?>

  <?php
  // If a category is set, display products for that category
  if(isset($_GET['category'])) {
      $cat = strtolower($_GET['category']);
      // Map category to specific product IDs:
      if($cat == 'shirt'){
          $ids = "7,4,8,6,2";
          $heading = "Shirts";
      } elseif($cat == 'tracksuit'){
          $ids = "1,3";
          $heading = "Tracksuits";
      } elseif($cat == 'jacket'){
          $ids = "10,5,9";
          $heading = "Jackets";
      } else {
          echo "<div class='container text-center mt-4'><p>Invalid category.</p></div>";
          exit;
      }
      $query = "SELECT * FROM categories WHERE product_id IN ($ids) ORDER BY FIELD(product_id, $ids)";
      $result = mysqli_query($con, $query);
      ?>
      <div class="container mt-4">
        <h2 class="text-center"><?php echo $heading; ?></h2>
        <div class="row">
        <?php
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $product_id          = $row['product_id'];
                $product_title       = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price       = $row['product_price'];
                $product_image       = $row['product_image'];
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
                            <p style='font-size: 0.9em; color: #555;'>All products are medium sized</p>
                            <p class='card-text'><strong>Price: \$$product_price</strong></p>
                            <a href='add_to_cart.php?product_id={$product_id}' class='btn btn-info'>Add to Cart</a>
                          </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p class='text-center'>No $heading available.</p>";
        }
        ?>
        </div>
      </div>
      <div class="container text-center mt-4 mb-4">
        <a href="index.php" class="btn btn-primary">Back to Home</a>
      </div>
  <?php
  // If a single product is specified, display its details
  } elseif(isset($_GET['product_id'])) {
      $product_id = mysqli_real_escape_string($con, $_GET['product_id']);
      $query = "SELECT * FROM categories WHERE product_id = '$product_id'";
      $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          $product_title       = $row['product_title'];
          $product_description = $row['product_description'];
          $product_price       = $row['product_price'];
          $product_image       = $row['product_image'];
          $image_path = 'Images/' . $product_image;
          if(!file_exists($image_path) || empty($product_image)){
              $image_path = 'Images/default.jpg';
          }
      } else {
          echo "<div class='container text-center mt-4'><p>No product found with the given ID.</p></div>";
          exit;
      }
      ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo $image_path; ?>" alt="<?php echo $product_title; ?>" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2><?php echo $product_title; ?></h2>
            <p><?php echo $product_description; ?></p>
            <p style='font-size: 0.9em; color: #555;'>All products are medium sized</p>
            <p><strong>Price: $<?php echo $product_price; ?></strong></p>
            <a href="add_to_cart.php?product_id=<?php echo $product_id; ?>" class="btn btn-info">Add to Cart</a>
            <a href="index.php" class="btn btn-primary">Back to Home</a>
          </div>
        </div>
      </div>
  <?php
  } else {
      echo "<div class='container text-center mt-4'><p>Invalid request.</p></div>";
  }
  ?>
  
  <!-- Include common footer -->
  <?php include('./includes/footer.php'); ?>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
