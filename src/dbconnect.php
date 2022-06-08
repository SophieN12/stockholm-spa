<?php
    $host       = "localhost";
    $database   = "e-shop";
    $user       = "root";
    $password       = "root";
    $charset    = "utf8mb4";

    $dsn = "mysql:host={$host};dbname={$database};charset={$charset}";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
        $pdo = new PDO($dsn, $user, $password, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>