<?php
include('../includes/connect.php');

// Form submission check
if (isset($_POST['Insert_Product'])) {

    // Retrieving form data
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keyword = $_POST['product_keyword'];
    $product_price = $_POST['product_price'];
    $product_status = 'true'; // Assuming status is set to 'true' by default

    // Image file handling
    if (isset($_FILES['Product_image']) && $_FILES['Product_image']['error'] == 0) {
        $product_image = $_FILES['Product_image']['name'];  // Get the file name
        $temp_image = $_FILES['Product_image']['tmp_name']; // Get the temporary file location

        // Move the uploaded image to the desired folder
        move_uploaded_file($temp_image, "./product_images/$product_image");
    } else {
        echo "<script>alert('Please upload an image.');</script>";
        exit();
    }

    // Check if any fields are empty
    if ($product_title == '' || $description == '' || $product_keyword == '' || $product_price == '' || $product_image == '') {
        echo "<script>alert('Please fill all the fields');</script>";
        exit();
    } else {
        // Insert query to add the product to the database
        $insert_products = "INSERT INTO `categories` (product_title, product_description, product_keyword, product_image, product_price, date, status) 
        VALUES ('$product_title', '$description', '$product_keyword', '$product_image', '$product_price', NOW(), '$product_status')";

        $result_query = mysqli_query($con, $insert_products);
        
        if ($result_query) {
            echo "<script>alert('Product inserted successfully');</script>";
        } else {
            echo "<script>alert('Error inserting product');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert Product</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container mt-3">
    <h1 class="text-center">Insert Product</h1>
    <!-- Form for product insertion -->
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Product Title -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required="required">
        </div>
        
        <!-- Product Description -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="description" class="form-label">Product Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" required="required">
        </div>
        
        <!-- Product Keyword -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="product_keyword" class="form-label">Product Keyword</label>
            <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter product keyword" required="required">
        </div>
        
        <!-- Product Image -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="Product_image" class="form-label">Product Image</label>
            <input type="file" name="Product_image" id="Product_image" class="form-control" required="required">
        </div>

        <!-- Product Price -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="Product_price" class="form-label">Product Price</label>
            <input type="text" name="product_price" id="Product_price" class="form-control" placeholder="Enter product price" required="required">
        </div>

        <!-- Submit Button -->
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="Insert_Product" class="btn btn-info" value="Insert Product">
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
