<?php
require('../src/config.php');

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if (isset($_POST['createOrderBtn']) && !empty($_SESSION['cartItems'])) {
    $firstName =      trim($_POST['firstName']);
    $lastName =       trim($_POST['lastName']);
    $email =          trim($_POST['email']);
    $password =       trim($_POST['password']);
    $street =         trim($_POST['street']);
    $postalCode =     trim($_POST['postalCode']);
    $phone =          trim($_POST['phone']);
    $city =           trim($_POST['city']);
    $country =        trim($_POST['country']);
    $cartTotelSum =   $_POST['cartTotalSum'];

    // FETCH USER IF EXIST
    $sql = "
        SELECT * FROM users
        WHERE email = :email;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    $userId = isset($user['id']) ? $user['id'] : null;


    // CREATE USER IF DOESN'T EXIST
    if (empty($user)) {
        $sql = "
            INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country) 
            VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postalCode, :city, :country);
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postalCode', $postalCode);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();
        $userId = $pdo->lastInsertId();
    }

    // CREATE ORDER
    $sql = "
        INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country) 
        VALUES (:user_id, :total_price, :billing_full_name, :billing_street, :billing_postalCode, :billing_city, :billing_country);
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId);
    $stmt->bindValue(':total_price', $cartTotelSum);
    $stmt->bindValue(':billing_full_name', $firstName . " " . $lastName);
    $stmt->bindValue(':billing_street', $street);
    $stmt->bindValue(':billing_postalCode', $postalCode);
    $stmt->bindValue(':billing_city', $city);
    $stmt->bindValue(':billing_country', $country);
    $stmt->execute();
    $orderId = $pdo->lastInsertId();


    foreach ($_SESSION['cartItems'] as $itemId => $item) {
        $sql = "
            INSERT INTO order_items (order_id, product_id, product_title, quantity, unit_price)
            VALUES (:order_id, :product_id, :product_title, :quantity, :unit_price);
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        $stmt->bindValue(':product_id', $item['id']);
        $stmt->bindValue(':product_title', $item['title']);
        $stmt->bindValue(':quantity', $item['quantity']);
        $stmt->bindValue(':unit_price', $item['price']);
        $stmt->execute();
    }

    header('Location: ../public/products/order-confirmation.php');
    exit;
}

header('Location: ../public/products/checkout.php');
exit;