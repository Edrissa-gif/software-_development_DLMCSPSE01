<?php
include('../includes/connect.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['Insert_product'])) {
    
    $product_title = $_POST['Insert_title'];

    
    if (!empty($product_title)) {
        
        $insert_query = "INSERT INTO products (product_title) VALUES ('$product_title')";

        
        $result = mysqli_query($con, $insert_query);

        
        if ($result) {
            echo "<script>alert('Product inserted successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "<script>alert('Product title cannot be empty');</script>";
    }
}
?>

<h2 class="text-center">Insert Products</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1">
            <i class="fa-solid fa-receipt"></i>
        </span>
        <input type="text" class="form-control" name="Insert_title" placeholder="Insert Product" aria-label="Product Title" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="Insert_product" value="Insert Product">
    </div>
</form>
