<?php
session_start();
include('./includes/connect.php');
include('./functions/common_function.php');
$search_query = isset($_GET['search_data']) ? mysqli_real_escape_string($con, $_GET['search_data']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Temps Clothing - Home</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <!-- Primary Navbar with Cart Dropdown -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Temps Clothing</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="display_all.php">Shop</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            <!-- Cart Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-cart-plus"></i>
                <sup><?php echo getCartItemCount(); ?></sup>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cartDropdown">
                <?php echo getCartItems(); ?>
              </ul>
            </li>
            
          </ul>
          <form class="d-flex" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" name="search_data">
            <button class="btn btn-outline-light" type="submit" name="search_data_product">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
  
  <!-- Secondary Navbar -->
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php if(isset($_SESSION['user_id'])): 
              $parts = explode('@', $_SESSION['user_email']);
              $firstName = ucfirst($parts[0]);
        ?>
          <li class="nav-item"><a class="nav-link" href="#">You are logged in as <?php echo $firstName; ?></a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="#">Welcome Guest</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
  
  <!-- Header Section -->
  <div class="container text-center mt-4">
    <h1 class="display-4">Temps Clothing</h1>
    <p class="lead">You Deserve To Be Seen</p>
  </div>
  
  <!-- Flash Message -->
  <?php
  if (isset($_SESSION['cart_message'])) {
      echo "<div class='container mt-4'><div class='alert alert-success text-center'>" . $_SESSION['cart_message'] . "</div></div>";
      unset($_SESSION['cart_message']);
  }
  ?>
  
  <!-- Products Section -->
  <div class="container mt-4">
    <div class="row">
      <?php echo getProducts($search_query, 4); ?>
    </div>
  </div>
  
  <!-- Include common footer -->
  <?php include("includes/footer.php"); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
