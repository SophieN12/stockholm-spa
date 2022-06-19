<?php

class UseradminDbHandler{

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Delete user
    public function deleteUser () {
        $sql = "
            DELETE FROM users 
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['userId']);
        $stmt->execute();
    }

    //Fetch all users
    public function fetchAllUsers() {
        $sql = "SELECT * FROM users;";
        $stmt = $this->pdo->query($sql);
        
        return $stmt->fetchAll();
    }

    //Fetch specific user
    public function fetchSpecificUser() {
        $sql = "
        SELECT * FROM users
        WHERE id =:id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['userId']);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    //Add User
    public function addUser($first_name, $last_name, $email, $password, $phone, $street, $postal_code, $city, $country) {
        $sql = "
        INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
        VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':first_name', $_POST['first_name']);
        $stmt->bindParam(':last_name', $_POST['last_name']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':street', $_POST['street']);
        $stmt->bindParam(':postal_code', $_POST['postal_code']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':country', $_POST['country']);
        $stmt->execute();
    }

    //Update User
    public function updateUser($id, $first_name, $last_name, $email, $password, $phone, $street, $postal_code, $city, $country) {
        $sql = "
        UPDATE users
        SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country
        WHERE id =:id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['userId']);
        $stmt->bindParam(':first_name', $_POST['first_name']);
        $stmt->bindParam(':last_name', $_POST['last_name']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $_POST['password']);
        $stmt->bindParam(':phone', $_POST['phone']);
        $stmt->bindParam(':street', $_POST['street']);
        $stmt->bindParam(':postal_code', $_POST['postal_code']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':country', $_POST['country']);
        $stmt->execute();
    }

}