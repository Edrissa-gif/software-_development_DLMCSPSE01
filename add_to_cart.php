<?php

include('./includes/connect.php');


if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
    
    $query = "SELECT * FROM card_details WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($con, $query);
    
    if (!$result) {
        die("Query error: " . mysqli_error($con));
    }
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['quantity'] + 1;
        $update_query = "UPDATE card_details SET quantity = '$new_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
        mysqli_query($con, $update_query);
        $_SESSION['cart_message'] = "Product already in cart, quantity updated.";
    } else {
        $insert_query = "INSERT INTO card_details (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)";
        mysqli_query($con, $insert_query);
        $_SESSION['cart_message'] = "Product added to cart.";
    }
    
    echo "<script>
            alert('{$_SESSION['cart_message']}');
            window.location.href = document.referrer;
          </script>";
    exit;
} else {
    echo "<script>
            alert('No product specified.');
            window.location.href = document.referrer;
          </script>";
    exit;
}
?>
