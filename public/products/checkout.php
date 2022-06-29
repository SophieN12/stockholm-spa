<?php
require('../../src/config.php');
$pageTitle = 'Checkout';
?>

<!DOCTYPE html>
<html>

<?php include('../layout/header.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../css/checkout.css">
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>
        <div class="inner-container">
            <section class="checkout-item-list">
                <ul>
                    <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) : ?>
                        <li>
                            <article class="checkout-item-module">
                                <img src="../admin/products/<?= $cartItem['img_url'] ?>" width="180">
                                <div class="cart-item-details">
                                    <h4><?= $cartItem['title'] ?></h4>
                                    <p><?= $cartItem['price'] ?> SEK</p>
                                </div>

                                <form class="update-cart-form" action="../update-cart-item.php" method="POST">
                                    <input type="hidden" name="cartId" value="<?= $cartId ?>">
                                    <input type="number" name="quantity" value="<?= $cartItem['quantity'] ?>" min="0">
                                </form>

                                <form action="../delete-cart-item.php" method="POST">
                                    <input type="hidden" name="cartId" value="<?= $cartId ?>">

                                    <button type="submit" class="btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </button>
                                </form>

                            </article>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section class="checkout-sidebar">
                <div class="total-section">
                    <p>Total</p>
                    <p><span class="cart-price"><?=$cartTotalSum ?></span> SEK</p>
                </div>

                <hr>

                <form action="../create-order.php" method="POST">
                    <input type="hidden" name="cartTotalSum" value="<?= $cartTotalSum ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first-name">First name</label>
                            <input type="text" class="form-control" name="firstName" id="first-name" placeholder="First name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last-name">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="last-name" placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input-email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="input-email" placeholder="E-mail">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-password">Password</label>
                            <input type="password" class="form-control" name="password" id="input-password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xl">
                            <label for="input-adress">Adress</label>
                            <input type="text" class="form-control" name="street" id="input-adress">
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="input-city">City</label>
                            <input type="text" class="form-control" name="city" id="input-city">
                        </div>
                    <div class="form-group col-md-6">
                            <label for="input-zip">Zip code</label>
                            <input type="text" class="form-control" name="postalCode" id="input-zip">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-country">Country</label>
                            <select name="country" id="input-country" class="form-control">
                                <option value="SE">Sweden</option>
                                <option value="NO">Norway</option>
                                <option value="DK">Denmark</option>
                                <option value="FI">Finland</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="formCheck">
                            <label class="form-check-label" for="formCheck">
                                Have read and agreed to the terms & conditions.
                            </label>
                        </div>
                    </div> -->
                    <div class="checkout-button-submit">
                        <button type="submit" name="createOrderBtn" class="btn btn-info btn-checkout">Complete purchase</button>
                    </div>
                </form>
            </section>

        </div>
    </div>

    <script type="text/javascript">
        $('.update-cart-form input[name="quantity"]').on('change', function() {
            $(this).parent().submit();
        });
    </script>

</body>
<?php include('../layout/footer.php'); ?>
</html>