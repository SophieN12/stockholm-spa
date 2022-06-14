<?php
require('../src/dbconnect.php');

$sql = "
    SELECT *
    FROM products
";
    
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>

<!DOCTYPE html>
<html>

<head>
    <title>All products</title>
    <link rel="stylesheet" href="../css/products.css">
</head>

<body>
    <ul id="product-grid">
        <?php foreach ($products as $product) { ?>
            <li>
                <a href="product.php?product=<?= $product['id'] ?>">
                    <img src="<?= htmlentities($product['img_url']) ?>" class="grid-img">
                    <h2><?= htmlentities($product['title']) ?></h2>
                    <p><?= htmlentities($product['price']) ?> SEK</p>
                </a>
            </li>
        <?php } ?>
    </ul>
</body>

</html>