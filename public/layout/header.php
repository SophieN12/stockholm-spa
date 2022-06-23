<!DOCTYPE html>
<html lang="sv"> 
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
</head>

<header>
    <nav class="nav_wrapper">
        <ul class="nav_list">
            <li><a class="navbar link" href="treatments.html">BEHANDLINGAR</a></li>
            <li><a class="navbar link" href="products.html">PRODUKTER</a></li>
            <li><a class="navbar link" id="kontakt" href="contact.html">KONTAKT</a></li>
        </ul>
        <a class="hamburgermenu link" href="#"><img src="../img/img-header/hamburger.svg" alt="hamburger menu icon"></a>
    </nav>

    <a href="index.html"><img class="logo link" src="../img/img-header/logga_spa.svg" alt="Brand logo"></a>
    
    <div class="header-icons">
        <a href=""><img id="search" src="../img/img-header/search.svg" alt="search icon" class="link"></a>
        <a href=""><img id="shoppingcart" src="../img/img-header/shoppingcart.svg" alt="shoppingcart icon" class="link"></a>
        <?php include('../cart.php'); ?>
    </div>
</header>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>