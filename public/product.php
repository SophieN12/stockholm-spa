<?php
require('../src/config.php');
$product = $productsDbHandler->fetchSpecificProduct($_GET['productId']);
$pageTitle = $product['title'];
?>

<!DOCTYPE html>
<html>

<?php include('../public/layout/header.php'); ?>

<head>
    <title><?= $pageTitle ?></title>
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
                <img src=../public/admin/products/<?=$product['img_url']?> class="img-large">
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

<?php include('../public/layout/footer.php'); ?>

</html>