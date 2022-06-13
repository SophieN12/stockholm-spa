<?php 

class ProductsDbHandler {
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function fetchAllProducts() {
        $sql = "SELECT * FROM products;";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function fetchSpecificProduct($productId) {
        $sql = "
                SELECT * FROM products
                WHERE id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindParam(':id', $productId);
        $stmt -> execute();

        return $stmt->fetch();
    }

    public function deleteProduct($productId) {
        $sql = "
            DELETE FROM products
            WHERE id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> bindParam(':id', $productId);
        $stmt -> execute();
    }

    public function addProduct($title, $description, $price, $stock, $imgUrl) {
        $sql = "
            INSERT INTO products (title, description, price, stock, img_url)
            VALUES (:title, :description, :price, :stock, :img_url)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':img_url', $imgUrl);
        $stmt->execute();
    }

    public function updateProduct($id, $title, $description, $price, $stock, $imgUrl) {
        $sql = "
                UPDATE products
                SET title = :title, description = :description, price = :price, stock = :stock, img_url = :img_url
                WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':img_url', $imgUrl);
        $stmt->execute();
    }
}

?>

