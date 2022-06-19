<?php

$host 	  = 'localhost';
$database = 'stockholmspa';
$user     = 'root';
$password = 'root';
$charset  = 'utf8mb4';

$dns 	  = "mysql:host={$host};dbname={$database};charset={$charset}";

$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
	$pdo = new PDO($dns, $user, $password, $options);
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
