<?php
session_start();
include('./includes/connect.php');
include('./functions/common_function.php');

// If user is already logged in, set a message.
if(isset($_SESSION['user_id'])){
    $logged_in_message = "You are already logged in as " . $_SESSION['user_email'] . ". <a href='index.php'>Go to Home</a>";
}

// Process registration form only if user is not logged in.
if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['user_id'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password']; // In production, hash the password
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password){
        $error = "Passwords do not match.";
    } else {
        // Check if email already exists
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $error = "Email already registered.";
        } else {
            $insert_query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
            if(mysqli_query($con, $insert_query)){
                $_SESSION['user_id'] = mysqli_insert_id($con);
                $_SESSION['user_email'] = $email;
                header("Location: index.php");
                exit;
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Temps Clothing</title>
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
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="display_all.php">Shop</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <li class="nav-item"><a class="nav-link active" href="register.php">Register</a></li>
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
         
        </div>
      </div>
    </nav>
  </div>
  
  <!-- Secondary Navbar -->
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_email']; ?></a></li>
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
  
  <!-- Registration Form or Logged In Message -->
  <div class="container mt-5">
    <?php if(isset($_SESSION['user_id'])): ?>
      <div class="alert alert-info text-center">
          <?php echo $logged_in_message; ?>
      </div>
    <?php else: ?>
      <h2 class="text-center">Register</h2>
      <?php if(isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
      <form action="register.php" method="post" class="w-50 mx-auto">
          <div class="mb-3">
              <label class="form-label">Email:</label>
              <input type="text" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Password:</label>
              <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
              <label class="form-label">Confirm Password:</label>
              <input type="password" name="confirm_password" class="form-control" required>
          </div>
          <div class="text-center">
              <button type="submit" class="btn btn-primary">Register</button>
          </div>
      </form>
      <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
    <?php endif; ?>
  </div>
  
  <!-- Footer -->
  <?php include("includes/footer.php"); ?>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
