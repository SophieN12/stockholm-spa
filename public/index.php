<?php
require('../src/config.php');
$products = $productsDbHandler->fetchAllProducts();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Stockholm Spa</title>
    <link rel="stylesheet" href="../css/products-page.css">
</head>

<body>
    <div class="container">
        <h1>All products</h1>
        <ul id="product-grid">
            <?php foreach ($products as $product) { ?>
                <li>
                    <a href="product.php?productId=<?= $product['id'] ?>">
                        <img src="<?= htmlentities($product['img_url']) ?>" class="grid-img">
                        <div class="product-grid-info">
                            <div class="product-grid-info-left">
                                <h3><?= htmlentities($product['title']) ?></h3>
                                <p><?= htmlentities($product['price']) ?> SEK</p>
                            </div>
                    </a>
                    <div class="product-grid-info-right">
                        <button>Add to cart</button>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>