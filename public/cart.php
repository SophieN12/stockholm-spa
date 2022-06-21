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
  <button class="btn btn-secondary dropdown-toggle" type="button" id="shoppingCartButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Shopping cart
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

    <span class="badge badge-pill badge-dangeer"><?=$cartItemCount?></span>

    <?php foreach($_SESSION['cartItems'] as $cartId => $cartItem): ?>
      <div class="row cart-detal">
      <img src="../admin/products/<?=$cartItem['img_url']?>" width="100">
      </div>
      <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
        <p><?=$cartItem['title']?></p>
        <span class="price text-info"><?=$cartItem['price']?> SEK</span><span class="count"><?=$cartItem['quantity']?></span>
      </div>
    <?php endforeach; ?>

    <div class="dropdown-divider"></div>

    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
      <p>Total <span class="text-info"><?=$cartTotalSum ?> SEK</span></p>
    </div>

    <div class="dropdown-divider"></div>

    <div class="row">
      <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
        <a href="../products/checkout.php" class="btn btn-primary btn-block">Checkout</a>
      </div>
    </div>
  </div>
</div>