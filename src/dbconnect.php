<?php

$host 		= "localhost";
$database 	= "e_butik";
$user 		= "root";
$pass 		= "root";
$charset 	= "utf8mb4";

$dsn 		= "mysql:host={$host};dbname={$database};charset={$charset}";

// För MAMP, så kan dns se lite olika ut
//$dns 	  = "mysql:unix_socket=/Application/MAMP/tmp/mysql/mysql.sock;dbname={$database}";

/**
 * Read about setting error mode:
 * https://www.php.net/manual/en/pdo.setattribute.php
 *
 * Read about different fetching styles:
 * https://www.php.net/manual/en/pdostatement.fetch.php
 */
$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Error mode
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch style, fetching associative array
];


try {
	$pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>