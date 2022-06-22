<?php
require('../src/config.php');
$pageTitle = 'Order confirmation';

if(empty($_SESSION['cartItems'])) {
    header('Location: ../public/products/checkout.php');
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pageTitle?></title>
</head>
<body>
    <h1>Grattis</h1>

    <?php foreach($cartItems as $item): ?> 
        <li>
            <article class="confirmation-module">
                <img src="../public/admin/products/<?=$item['img_url']?>" width="250">
                    <div class="confirmation-item-details">
                        <h4><?=$item['title']?></h4>
                        <p><?=$item['price']?> SEK</p>
                    </div>
            </article>
        </li>

        <p>Total: <?=$totalSum?> SEK</p>
    <?php endforeach; ?>
</body>
</html>