<?php
session_start();
include('./includes/connect.php');

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
    
    $delete_query = "DELETE FROM card_details WHERE user_id = '$user_id' AND product_id = '$product_id'";
    mysqli_query($con, $delete_query);
}
header("Location: cart.php");
exit;
?>
