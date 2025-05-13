<!DOCTYPE html>
<html lang="en">
   <head>
   <meta charset="UTF-8" >
        <meta htttp-equiv="X-UA-Compatible" content="IE=edge>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <!-- bootstrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       
       <!-- font awesome link-->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" 
       rel="stylesheet">
       
        <!--css file-->
       <link rel="stylesheet" href="../Style.css">
    <style>
        .admin_image{
    width:100px;
}
.footer{
    position:absolute;
    bottom:0;
}
</style>
</head>
<body>
<!--navbar -->
<div class="container-fluid p-0">
    <!-- first child --> 

    <nav class ="navbar navbar-expand-lg navbar-light bg-info">
<div class="container-fluid">
   <img src="../images/images face.jpg" alt="" class="logo">
   <nav class ="navbar navbar-expand-lg "></nav>
   <ul class="navbar-nav">
   <li class="nav-item">
    <a href="" class="nav-link">Welcome Guest</a>
   </li>
</ul>
</div>
 </nav>

 <!-- second child -->
  <div class="bg-light">
    <h3 class="text-center p-2">Manage details</h3>
  </div>
  <!-- third child-->
   <div class="row">
    <dic class="col-md-12 bg-secondary p-1 align-items-center">
        <div>
          <a href="#"><img src="../images/imagesfff.png" alt="" class="admin_image"> </a>  
          <p class="text-light text-center">Admin Name</p>
        </div>
        
        <!-- button-->
        <div class="button text-center">
        <button><a href="Index.php?Insert_Products" class="nav-link text-light bg-info my-1">Insert Products</a></button>
           <button><a href="Insert_categories.php" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
           

    </div>
</div>

<!-- forth child -->
 <div class="container my-3">
    <?php 
    if(isset($_GET[ 'Insert_Products'])){
   include('Insert_products.php');
    }
    ?>
 </div>
 


<!-- last child-->
 <div class="bg-info p-3 text-center footer">
    <p> All rights sreserved - Designed by Edrissa -2025</p>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>