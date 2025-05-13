<?php
session_start();
?>
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
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="display_all.php">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
          <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item"><a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_email']; ?></a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          <?php else: ?>
            
          <?php endif; ?>
          <!-- You can also include the Cart Dropdown here -->
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
        
      </div>
    </div>
  </nav>
</div>
<!-- Secondary Navbar -->
<div class="container-fluid">
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link" href="#">Welcome Guest</a></li>
      <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
    </ul>
  </nav>
</div>
<!-- Header Section -->
<div class="container text-center mt-4">
  <h1 class="display-4">Temps Clothing</h1>
  <p class="lead">You Deserve To Be Seen</p>
</div>
