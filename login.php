<?php

include('./includes/connect.php');
include('./functions/common_function.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password']; // In production, use password_hash() and password_verify()

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        if($password == $user['password']){ // Replace with password_verify() in production
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            // Extract first name from email (everything before '@')
            $parts = explode('@', $user['email']);
            $firstName = ucfirst($parts[0]);
            echo "<script>
                    alert('You have been logged in as $firstName');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Email not found. Please register.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Temps Clothing</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <!-- Include common header with navbar and cart dropdown -->
  <?php include('header.php'); ?>
  
  <div class="container mt-5">
    <h1 class="text-center">Login</h1>
    <?php if(isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
    <form action="login.php" method="post" class="w-50 mx-auto">
      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="text" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password:</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
  </div>
  
  <!-- Include common footer -->
  <?php include("includes/footer.php"); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
