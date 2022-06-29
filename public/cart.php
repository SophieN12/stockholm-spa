<?php

  // echo "<pre>";
  // print_r($_SESSION['cartItems']);
  // echo "</pre>";

  if (!isset($_SESSION['cartItems'])) {
    $_SESSION['cartItems'] = [];
  }

  $cartItemCount = count($_SESSION['cartItems']);
  $cartTotalSum = 0;
  foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
    $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
  }

  // om man vill att totalen ska r'kna med quantity
  // $cartItemCount = 0;
  // $cartTotalSum = 0;
  // foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  //   $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
  //   $cartItemCount += $cartItem['quantity'];
  // }
?>

<div class="dropdown">
  <img id="shoppingcart" src="../img/img-header/shoppingcart.svg" alt="shoppingcart icon" class="link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem): ?>
      <div class="cart-detail row">
        <img src= <?php if ($pageTitle == "Admin Products") {echo $cartItem['img_url'];} 
                        else if ($pageTitle == "Admin Users"){ echo "../products/". $cartItem['img_url'];}
                        else {echo "../admin/products/" . $cartItem['img_url'];}?> width="100">
        <div class="cart-detail-product">
          <p><?=$cartItem['title']?></p>
          <span class="cart-price"><?=$cartItem['price']?> SEK</span>
          <span class="cart-quantity">Quantity: <?=$cartItem['quantity']?></span>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="dropdown-divider"></div>

    <div class="total-section">
      <p>Total</p>
      <p><span class="cart-price"><?=$cartTotalSum ?></span> SEK</p>
    </div>

    <div class="dropdown-divider"></div>

    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
        <a href="../products/checkout.php" class="btn btn-checkout">Checkout</a>
      </div>
    </div>
  </div>
</div>