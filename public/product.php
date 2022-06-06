<?php
require('../src/dbconnect.php');

$sql = "
SELECT * FROM products
WHERE id = :id;
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['product']);
$stmt->execute();
$product = $stmt->fetch();


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
</head>
<body>
        <img src="<?= htmlentities($product['img_url']) ?>">
        <h2><?= htmlentities($product['title']) ?></h2>
        <p><?= htmlentities($product['price']) ?></p>
</body>
</html>