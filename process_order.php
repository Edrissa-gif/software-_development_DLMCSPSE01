<?php
session_start();
include('./includes/connect.php');

// Retrieve form data
$name = mysqli_real_escape_string($con, $_POST['name']);
$address = mysqli_real_escape_string($con, $_POST['address']);

// Payment fields (for simulation only)
$card_number = mysqli_real_escape_string($con, $_POST['card_number']);
$exp_date = mysqli_real_escape_string($con, $_POST['exp_date']);
$cvv = mysqli_real_escape_string($con, $_POST['cvv']);

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

// Calculate total from the cart
$query = "SELECT cd.quantity, c.product_price FROM card_details cd 
          LEFT JOIN categories c ON cd.product_id = c.product_id 
          WHERE cd.user_id = '$user_id'";
$result = mysqli_query($con, $query);
$total = 0;
while($row = mysqli_fetch_assoc($result)) {
    $total += $row['product_price'] * $row['quantity'];
}

// Insert order into orders table
$order_query = "INSERT INTO orders (user_id, name, address, total, order_date)
                VALUES ('$user_id', '$name', '$address', '$total', NOW())";
mysqli_query($con, $order_query);
$order_id = mysqli_insert_id($con);

// Insert each cart item into order_items table
$query = "SELECT * FROM card_details WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity)
                         VALUES ('$order_id', '$product_id', '$quantity')";
    mysqli_query($con, $order_item_query);
}

// Clear the cart for the user.
$delete_query = "DELETE FROM card_details WHERE user_id = '$user_id'";
mysqli_query($con, $delete_query);

// --- Send Order Confirmation Email ---
// Retrieve customer email from session (make sure it's set during login/registration)
$customer_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
if($customer_email){
    $subject = "Your Order is Being Processed";
    $message = "Dear Customer,\n\nThank you for your order (Order #{$order_id}). Your order totaling \$$total is now being processed and will be delivered within 10 days.\n\nRegards,\nTemps Clothing";
    $headers = "From: no-reply@yourdomain.com\r\n" .
               "Reply-To: support@yourdomain.com\r\n" .
               "X-Mailer: PHP/" . phpversion();
    // Send email (ensure your PHP mail configuration is correct)
    mail($customer_email, $subject, $message, $headers);
}

// Simulate payment success message and log out the user.
echo "<script>
        alert('Your order is successful! An email confirmation has been sent to you.');
        window.location.href = 'logout.php';
      </script>";
exit;
?>
