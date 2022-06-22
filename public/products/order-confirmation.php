<?php
require('../../src/config.php');
$pageTitle = 'Order confirmation';

if(empty($_SESSION['cartItems'])) {
    header('Location: checkout.php');
    exit;
}

$cartItems = $_SESSION['cartItems'];
$totalSum = 0;
foreach ($cartItems as $cartId => $cartItem) {
    $totalSum += $cartItem['price'] * $cartItem['quantity'];
}

unset($_SESSION['cartItems']);
?>

<!DOCTYPE html>
<html lang="en">

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
        <h1>Order confirmation</h1>


        <section class="checkout-item-list">
            <ul>
                <?php foreach ($cartItems as $item) : ?>
                    <li>
                        <article class="confirmation-item-module">
                            <img src="../admin/products/<?= $cartItem['img_url'] ?>" width="250">
                            <div class="confirmation-item-details">
                                <h4><?= $cartItem['title'] ?></h4>
                                <p><span class="confirmation-detail-total"><?= $cartItem['price'] ?> SEK</span></p>
                            </div>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <div class="order-total">
            <p>Total: <?=$totalSum?> SEK</p>
            <i>Thank you for your purchase!</i>
        </div>
    </div>
</body>

<?php include('../layout/footer.php'); ?>

</html>