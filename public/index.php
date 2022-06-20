<?php
require('../src/config.php');
$products = $productsDbHandler->fetchAllProducts();
?>

<!DOCTYPE html>
<html>

<?php include('../public/layout/header.php'); ?>

<head>
    <title>Stockholm Spa</title>
    <link rel="stylesheet" href="../public/css/products-page.css">
</head>

<body>
    <div class="container">
        <h1>All products</h1>
        <ul id="product-grid">
            <?php foreach ($products as $product) { ?>
                <li>
                    <a href="product.php?productId=<?= $product['id'] ?>">
                        <img src=../public/admin/products/<?=$product['img_url']?> class="grid-img">
                        <div class="product-grid-info">
                            <div class="product-grid-info-left">
                                <h3><?= htmlentities($product['title']) ?></h3>
                                <p><?= htmlentities($product['price']) ?> SEK</p>
                            </div>
                    </a>
                    <div class="product-grid-info-right">
                        <button class="btn">Add to cart</button>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

<?php include('../public/layout/footer.php'); ?>

</html>