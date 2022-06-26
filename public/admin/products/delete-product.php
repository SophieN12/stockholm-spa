<?php
require('../../../src/config.php');

$message =  "";
$product = [];

if (isset($_GET['productId'])) {
    $sql = "
        SELECT * FROM products 
        WHERE id = :id
        ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_GET['productId']);
    $stmt->execute();
    $product = $stmt->fetchAll();

    $productsDbHandler -> deleteProduct($_GET['productId']);
    $message = "You have succesfully deleted product with ID: " . $_GET['productId'];
    $status = true;

} else {
    $message = "Something went wrong! Product did not get deleted from the database.";
    $status = false;
}

$data = [
    'status' => $status,
    'message' => $message,
    'product'   => $product
];

echo json_encode($data);
