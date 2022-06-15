<?php

class productsDbHandler {
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function fetchAllProducts() {
        $sql = "
        SELECT *
        FROM products
        ";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function fetchProduct($productId) {
        $sql = "
        SELECT * FROM products
        WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $productId);
        $stmt->execute();
        return $stmt->fetch();
    }
}

?>