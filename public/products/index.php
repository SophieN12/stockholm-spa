<?php
require('../../src/config.php');
$products = $productsDbHandler->fetchAllProducts();
?>

<?php include('../layout/header.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Stockholm Spa</title>
    <link rel="stylesheet" href="../../public/css/products-page.css">
</head>

<body>
    <div class="container">
        <h1>All products</h1>
        <ul id="product-grid">
            <?php foreach ($products as $product) { ?>
                <li>
                    <a href="product.php?productId=<?= $product['id'] ?>">
                        <img src="../admin/products/<?=$product['img_url']?>" class="grid-img">
                        <div class="product-grid-info">
                            <div class="product-grid-info-left">
                                <h3><?= htmlentities($product['title']) ?></h3>
                                <p><?= htmlentities($product['price']) ?> SEK</p>
                            </div>
                    </a>
                    <div class="product-grid-info-right">
                        <form action="../add-cart-item.php" method="POST">
                            <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                            <input type="number" name="quantity" value="1" min="0">
                            <input type="submit" name="addToCart" value="Add to cart">
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>

<?php include('../layout/footer.php'); ?>
