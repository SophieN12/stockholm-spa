<?php
require('../src/config.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (!empty($_POST['quantity'])) {
    $productId = (int) $_POST['productId'];
    $quantity = (int) $_POST['quantity'];

    $sql = "
        SELECT * FROM products
        WHERE id = :id;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $productId);
    $stmt->execute();
    $product = $stmt->fetch();

    // echo "<pre>";
    // print_r($product);
    // echo "</pre>";

    if ($product) {
        $product = array_merge($product, ['quantity' => $quantity]);

        $cartItem = [$productId => $product];

        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";

        if (empty($_SESSION['cartItems'])) {
            $_SESSION['cartItems'] = $cartItem;
        } else {
            if (isset($_SESSION['cartItems'][$productId])) {
                $_SESSION['cartItems'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cartItems'] += $cartItem;
            }
        }
        // echo "<pre>";
        // print_r($_SESSION['cartItems']);
        // echo "</pre>";
    }
}

if (!empty($_SERVER['HTTP_REFERER']))
    header("Location: ".$_SERVER['HTTP_REFERER']);
else
   echo "No referrer.";
?>