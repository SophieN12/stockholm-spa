<?php
    require('../src/config.php');
    $product = $productsDbHandler->fetchProduct($_GET['productId']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
    <link rel="stylesheet" href="../css/products.css">
</head>
<body>
        <img src="<?= htmlentities($product['img_url']) ?>" class="img-large">
        <h2><?= htmlentities($product['title']) ?></h2>
        <p><?= htmlentities($product['price']) ?></p>
</body>
</html>