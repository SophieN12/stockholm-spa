<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'

// Include functions and classes
require(SRC_PATH . '/dbconnect.php');
require(SRC_PATH . '/app/userFunctions.php');
require(SRC_PATH . '/app/UsersDbHandler.php');
$usersDbHandler = new UsersDbHandler($pdo);
