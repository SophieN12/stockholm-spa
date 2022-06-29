<?php
require('../../../src/config.php');

$successMessage="";
$message	="";
$error		="";
$first_name	="";
$last_name	="";
$email		="";
$passowrd	="";
$phone		="";
$street		="";
$postal_code="";
$city		="";
$country	="";

if(isset($_POST['addUserBtn'])) {

	$first_name		=trim($_POST['first_name']);
	$last_name		=trim($_POST['last_name']);
	$email			=trim($_POST['email']);
	$passowrd		=trim($_POST['password']);
	$phone			=trim($_POST['phone']);
	$street			=trim($_POST['street']);
	$postal_code	=trim($_POST['postal_code']);
	$city			=trim($_POST['city']);
	$country		=trim($_POST['country']);

	if (empty($first_name)) {
		$error .= "Förnamn är obligatoriskt <br>";
	}
	if (empty($last_name)) {
		$error .= "Efternamn är obligatoriskt <br>";
	}
	if (empty($email)) {
		$error .= "Email är obligatoriskt <br>";
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error .= "Ogiltig e-post adress<br>";
	}
	if (empty($passowrd)) {
		$error .= "Lösenord är obligatoriskt <br>";
	}
	if (empty($phone)) {
		$error .= "Mobilnummer är obligatoriskt <br>";
	}
	if (empty($street)) {
		$error .= "Adress är obligatoriskt <br>";
	}
	if (empty($postal_code)) {
		$error .= "Postnummer är obligatoriskt <br>";
	}
	if (!filter_var($postal_code, FILTER_VALIDATE_INT)) {
		$error .= "Ogiltigt postnummer <br>";
	}
	if (empty($city)) {
		$error .= "Stad är obligatoriskt <br>";
	}
	if (empty($country)) {
		$error .= "Land är obligatoriskt <br>";
	}

	if ($error) {
		$message = "
			<div>
				{$error}
			</div>
		";
	} else {
		$useradminDbHandler->addUser($first_name, $last_name, $email, $password, $phone, $street, $postal_code, $city, $country);
		$successMessage = "
			<div>
				Ny användare är skapad!
			</div>
		";
	}
}

$users = $useradminDbHandler->fetchAllUsers();

$data = [
    'message' => $message,
    'users'   => $users,
	'successmessage' => $successMessage
];

echo json_encode($data);
