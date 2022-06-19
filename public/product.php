<?php
require('../src/config.php');
$product = $productsDbHandler->fetchSpecificProduct($_GET['productId']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product</title>
    <link rel="stylesheet" href="../public/css/products-page.css">
</head>

<body>
    <div class="container">
        <div class="product-navigation">
            <a href="index.php">
                << Go back to all products</a>
        </div>
        <div class="product-description">
            <div class="product-desc-left">
                <img src="<?= $product['img_url'] ?>" class="img-large">
            </div>
            <div class="product-desc-right">
                <h2><?= htmlentities($product['title']) ?></h2>
                <div class="product-desc-mid-right">
                    <p><?= htmlentities($product['price']) ?> SEK</p>
                    <p><?= htmlentities($product['stock']) ?> in stock</p>
                </div>
                <p><?= htmlentities($product['description']) ?></p>
                <button>Add to cart</button>
            </div>
        </div>
    </div>
</body>

</html>