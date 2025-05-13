<?php

include('./includes/connect.php');
include('./functions/common_function.php');

// Fetch cart items for the current user
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
$query = "SELECT cd.quantity, c.product_title, c.product_price, c.product_image, c.product_id 
          FROM card_details cd 
          LEFT JOIN categories c ON cd.product_id = c.product_id 
          WHERE cd.user_id = '$user_id'";
$result = mysqli_query($con, $query);
$total = 0;
$cartItems = array();
while($row = mysqli_fetch_assoc($result)) {
    $total += $row['product_price'] * $row['quantity'];
    $cartItems[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Temps Clothing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
</head>
<body>
  <!-- Include common header (with navbar, including the cart logo & dropdown) -->
  <?php include('header.php'); ?>

  <div class="container mt-4">
    <h1 class="text-center">Checkout</h1>
    <?php if (!empty($cartItems)): ?>
      <h3>Your Cart</h3>
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
          <?php foreach($cartItems as $item): 
                  $image_path = 'Images/' . $item['product_image'];
                  if (!file_exists($image_path) || empty($item['product_image'])) {
                      $image_path = 'Images/default.jpg';
                  }
          ?>
            <tr>
              <td><?php echo $item['product_title']; ?></td>
              <td><img src="<?php echo $image_path; ?>" alt="<?php echo $item['product_title']; ?>" style="width:80px; height:80px; object-fit:cover;"></td>
              <td>$<?php echo $item['product_price']; ?></td>
              <td><?php echo $item['quantity']; ?></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="3" class="text-end"><strong>Total:</strong></td>
            <td>$<?php echo $total; ?></td>
          </tr>
        </tbody>
      </table>
      <!-- Checkout Form -->
      <form action="process_order.php" method="post">
        <h3>Shipping Information</h3>
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control" required></textarea>
        </div>
        <h3>Payment Information</h3>
        <div class="mb-3">
          <label class="form-label">Credit Card Number</label>
          <input type="text" name="card_number" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Expiration Date</label>
          <input type="text" name="exp_date" class="form-control" placeholder="MM/YY" required>
        </div>
        <div class="mb-3">
          <label class="form-label">CVV</label>
          <input type="text" name="cvv" class="form-control" required>
        </div>
        <!-- Side-by-Side Buttons -->
        <div class="row">
          <div class="col-md-6 text-center">
            <a href="index.php" class="btn btn-primary">Continue Shopping</a>
          </div>
          <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-success">Place Order</button>
          </div>
        </div>
      </form>
    <?php else: ?>
      <p class="text-center">Your cart is empty.</p>
      <div class="text-center">
        <a href="index.php" class="btn btn-primary">Continue Shopping</a>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- Include common footer -->
  <?php include("includes/footer.php"); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
