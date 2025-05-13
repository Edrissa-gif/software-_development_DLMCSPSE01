<?php

include('./includes/connect.php');
include('./functions/common_function.php');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize inputs
    $name    = mysqli_real_escape_string($con, $_POST['name']);
    $email   = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    
    // Instead of sending an email, simply show a success message and reload the page.
    echo "<script>
            alert('Your message has been received, we will get back to you soon.');
            window.location.href='contact.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact - Temps Clothing</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <!-- Include common header (navbar, cart dropdown, header section) -->
  <?php include('header.php'); ?>
  
  <!-- Contact Form Section -->
  <div class="container mt-5">
    <h2 class="text-center">Contact Us</h2>
    <p class="text-center">We'd love to hear from you. Please fill out the form below.</p>
    <form action="contact.php" method="post" class="w-50 mx-auto">
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message:</label>
        <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
    </form>
  </div>
  
  <!-- Include common footer -->
  <?php include("includes/footer.php"); ?>
  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
