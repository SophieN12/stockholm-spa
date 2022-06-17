<?php
    require('../src/config.php');
    $products = $productsDbHandler->fetchAllProducts();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Stockholm Spa</title>
    <link rel="stylesheet" href="../css/products.css">
</head>

<body>
	<h1>All products</h1>
    <ul id="product-grid">
        <?php foreach ($products as $product) { ?>
            <li>
                <a href="product.php?productId=<?= $product['id'] ?>">
                    <img src="<?= htmlentities($product['img_url']) ?>" class="grid-img">
                    <h2><?= htmlentities($product['title']) ?></h2>
                    <p><?= htmlentities($product['price']) ?> SEK</p>
                </a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>