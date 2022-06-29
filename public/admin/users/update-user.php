<?php 
require('../../../src/config.php');
$pageTitle = "Update user";

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

if(isset($_POST['updateUserBtn'])) {

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
        $useradminDbHandler->updateUser($_GET['userId'], $first_name, $last_name, $email, $password, $phone, $street, $postal_code, $city, $country);
		$successMessage = "
		<div>
			Användaren är uppdaterad!
		</div>
		";
	}
}

$user = $useradminDbHandler->fetchSpecificUser();

?>

<?php include('../layout/header.php'); ?>
<link rel="stylesheet" type=""text/css" href="../css/useradmin.css"/>

<section class="new-user-section">

	<div class="new-user-wrapper">
		
		<h1 class="rubrik">Update user</h1>
		<div class="error"><?=$message?></div>
		<div class="success"><?=$successMessage?></div>

		<form id="add-user-form" action="" method="POST">
				<div id="field-wrapper">
					<label for="">Firstname</label>
					<input type="text" class="inputfield" name="first_name" placeholder="First Name" value="<?=htmlentities($user['first_name'])?>">
				</div>
				<div id="field-wrapper">
					<label for="">Lastname</label>
					<input type="text" class="inputfield" name="last_name" placeholder="Last Name" value="<?=htmlentities($user['last_name'])?>">
				</div>
				<div id="field-wrapper">
					<label for="">password</label>
					<input type="text" class="inputfield" name="password" placeholder="Password" value="<?=htmlentities($user['password'])?>">
				</div>
				<div id="field-wrapper">
					<label for="">Phonenumber</label>
					<input type="text" class="inputfield" name="phone" placeholder="Phonenumber" value="<?=htmlentities($user['phone'])?>">
				</div>
				<div id="field-wrapper">
					<label for="">Street</label>
					<input type="text" class="inputfield" name="street" placeholder="Street" value="<?=htmlentities($user['street'])?>">
				</div>
				<div id="field-wrapper">
					<label for="">Postalcode</label>
					<input type="text" class="inputfield" name="postal_code" placeholder="Postal Code" value="<?=htmlentities($user['postal_code'])?>">
				</div>
				<div id="field-wrapper">
					<label for="">City</label>
					<input type="text" class="inputfield" name="city" placeholder="City" value="<?=htmlentities($user['city'])?>">
				</div>

				<div id="field-wrapper">
					<label for="country">Välj land</label>
					<select name="country" id="country" class="inputfield" value="<?=htmlentities($user['country'])?>">
						<option selected><?=htmlentities($user['country'])?></option>
						<option name="sweden" value="Sweden">Sweden</option>
						<option name="Norway" value="Norway">Norway</option>
						<option name="Denmark" value="Denmark">Denmark</option>
						<option name="Finland" value="Finland">Finland</option>
					</select>
				</div>
				<div class="long">
					<label for="">Email</label>
					<input type="text" class="inputfield" name="email" placeholder="E-mail" value="<?=htmlentities($user['email'])?>">
				</div>
				<div class="buttons update-buttons">
					<input type="submit" name="updateUserBtn" value="Uppdatera" class="add-user-btn"> 
					<a class="add-user-btn return-btn" href="useradmin.php">Tillbaka</a>
				</div>
		</form>
	</div>
</section>

<?php include('../layout/footer.php'); ?>