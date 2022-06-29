<!DOCTYPE html>
<html lang="sv"> 
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/header.css"/>
    <link rel="stylesheet" href="../css/footer.css"/>
    <link rel="stylesheet" href="../../css/checkout.css"/>
    <title><?=$pageTitle?></title>
</head>

<header>
    <nav class="navbar">
            <a id="products-link" class="link <?php if($pageId == "products") {echo "marked";}?>" href="../../products/index.php">PRODUCTS</a>
            <div class="dropdown-nav">
                <button id="admin-link" class="link dropbtn <?php if($pageId == "admin") {echo "marked";}?>">ADMIN</button>
                <div class="dropdown-nav-content">
                    <a href="../products/manage-products.php" class="link manage-links">PRODUCTS</a>
                    <a href="../users/useradmin.php" class="link manage-links">USERS</a>
                </div>
            </div>
    </nav>

    <a href="../../products/index.php"><img class="logo link" src="../img/img-header/logga_spa.svg" alt="Brand logo"></a>
    
    <div class="header-icons">
        <a href="<?php if(isset($_SESSION['email'])) {echo "../../users/my-page.php";} else {echo "../../users/login.php";}?>">
        <img id ="my-page-icon" src="<?php if(isset($_SESSION['email'])) {echo "../img/img-header/group-check.svg";} else {echo "../img/img-header/Group.svg";}?>" alt="" height="40"></a>
        <?php include('../../cart.php'); ?>
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
