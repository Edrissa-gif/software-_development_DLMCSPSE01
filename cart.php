<?php

include('./includes/connect.php');
include('./functions/common_function.php');

// Fetch cart items for the current user (default user_id = 1 if not logged in)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
$query = "SELECT cd.quantity, c.product_title, c.product_price, c.product_image 
          FROM card_details cd 
          LEFT JOIN categories c ON cd.product_id = c.product_id 
          WHERE cd.user_id = '$user_id'";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart - Temps Clothing</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <!-- Include common header (with navbar, cart dropdown, etc.) -->
  <?php include('header.php'); ?>
  
  <div class="container text-center mt-4">
    <h1>Your Cart</h1>
  </div>
  
  <div class="container mt-4">
    <?php if(mysqli_num_rows($result) > 0): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)):
                  $product_title = $row['product_title'];
                  $product_price = $row['product_price'];
                  $quantity = $row['quantity'];
                  $product_image = $row['product_image'];
                  $image_path = 'Images/' . $product_image;
                  if(!file_exists($image_path) || empty($product_image)){
                      $image_path = 'Images/default.jpg';
                  }
          ?>
          <tr>
            <td><?php echo $product_title; ?></td>
            <td>
              <img src="<?php echo $image_path; ?>" alt="<?php echo $product_title; ?>" 
                   style="width:80px; height:80px; object-fit:cover;">
            </td>
            <td>$<?php echo $product_price; ?></td>
            <td><?php echo $quantity; ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <div class="text-center">
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
      </div>
    <?php else: ?>
      <p class="text-center">Your cart is empty.</p>
      <div class="text-center">
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- Include common footer -->
  <?php include("includes/footer.php"); ?>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
