<?php

class UsersDbHandler {
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function fetchUserByEmail ($email) {
        $sql = "
            SELECT * FROM users
            WHERE email = :email
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    function deleteUser () {
        $sql = "
            DELETE FROM users
            WHERE id = :id    
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['id']);
        return $stmt->execute();
    }

    function updateUser ($first_name, $last_name, $email, $encryptedPassword, $phone,
     $street, $postal_code, $city, $country) {
        $sql = "
        UPDATE users
        SET 
        first_name = :first_name, 
        last_name = :last_name, 
        email = :email, 
        password = :password, 
        phone = :phone, 
        street = :street, 
        postal_code = :postal_code, 
        city = :city, 
        country = :country
        WHERE id = :id
        ";
               
        $id = $_SESSION['id'];
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    function createUser ($first_name, $last_name, $email, $password, $phone,
     $street, $postal_code, $city, $country) {
        $sql = "
        INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country) 
        VALUES (:first_name, :last_name, :email,  :password, :phone, :street, :postal_code, :city, :country)";
        
        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        return $stmt->execute();
    }
}
