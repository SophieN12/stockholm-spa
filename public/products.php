<?php
require('../src/dbconnect.php');

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();

echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>All products</title>
</head>
<body>
    <?php foreach ($products as $product) { ?>
        <ul>
            <li>
                <img src="<?= htmlentities($product['img_url']) ?>">
                <h2><?= htmlentities($product['title']) ?></h2>
                <p><?= htmlentities($product['price']) ?></p>

                <a href="product.php?productId=<?=$product['id']?>">Show post</a>
            </li>
        </ul>
    <?php } ?>
</body>
</html>
