<?php
require('../src/config.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (
    isset($_POST['cartId'])
    && isset($_SESSION['cartItems'][$_POST['cartId']])
) {
    unset($_SESSION['cartItems'][$_POST['cartId']]);
}

if (!empty($_SERVER['HTTP_REFERER']))
    header("Location: ".$_SERVER['HTTP_REFERER']);
else
   echo "No referrer.";
exit;
