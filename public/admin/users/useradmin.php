<?php
require('../../../src/config.php');
$pageTitle = "Admin Users";

$message	="";
// $message	="";
// $error		="";
// $first_name	="";
// $last_name	="";
// $email		="";
// $passowrd	="";
// $phone		="";
// $street		="";
// $postal_code="";
// $city		="";
// $country	="";
// // Add user with validation
// if(isset($_POST['addUserBtn'])) {

// 	$first_name		=trim($_POST['first_name']);
// 	$last_name		=trim($_POST['last_name']);
// 	$email			=trim($_POST['email']);
// 	$passowrd		=trim($_POST['password']);
// 	$phone			=trim($_POST['phone']);
// 	$street			=trim($_POST['street']);
// 	$postal_code	=trim($_POST['postal_code']);
// 	$city			=trim($_POST['city']);
// 	$country		=trim($_POST['country']);

// 	if (empty($first_name)) {
// 		$error .= "Förnamn är obligatoriskt <br>";
// 	}
// 	if (empty($last_name)) {
// 		$error .= "Efternamn är obligatoriskt <br>";
// 	}
// 	if (empty($email)) {
// 		$error .= "Email är obligatoriskt <br>";
// 	}
// 	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 		$error .= "Ogiltig e-post adress<br>";
// 	}
// 	if (empty($passowrd)) {
// 		$error .= "Lösenord är obligatoriskt <br>";
// 	}
// 	if (empty($phone)) {
// 		$error .= "Mobilnummer är obligatoriskt <br>";
// 	}
// 	if (empty($street)) {
// 		$error .= "Adress är obligatoriskt <br>";
// 	}
// 	if (empty($postal_code)) {
// 		$error .= "Postnummer är obligatoriskt <br>";
// 	}
// 	if (!filter_var($postal_code, FILTER_VALIDATE_INT)) {
// 		$error .= "Ogiltigt postnummer <br>";
// 	}
// 	if (empty($city)) {
// 		$error .= "Stad är obligatoriskt <br>";
// 	}
// 	if (empty($country)) {
// 		$error .= "Land är obligatoriskt <br>";
// 	}

// 	if ($error) {
// 		$message = "
// 			<div>
// 				{$error}
// 			</div>
// 		";
// 	} else {
// 		$useradminDbHandler->addUser($first_name, $last_name, $email, $password, $phone, $street, $postal_code, $city, $country);
// 	}
// }



// Delete user
if(isset($_POST['deleteUserBtn'])){
	$useradminDbHandler->deleteUser();
}

// Hämtar ALLA
$users = $useradminDbHandler->fetchAllUsers();

// echo "<pre>";
// print_r($users);
// echo "</pre>";

?>

<?php include('../layout/header.php'); ?>
<link rel="stylesheet" type=""text/css" href="../css/useradmin.css"/>

<body>

	<section class="new-user-section">

		<div class="new-user-wrapper">

			<h1 class="rubrik">Create new user</h1>
			<div id="form-message" > <?=$message?> </div>

			<!-- ny användare steg 2 -->
			<form id="add-user-form" action="add-user.php" method="POST">

				<div id="field-wrapper">
					<label for="">Firstname</label>
					<input type="text" class="inputfield" name="first_name" placeholder="First Name">
				</div>
				<div id="field-wrapper">
					<label for="">Lastname</label>
					<input type="text" class="inputfield" name="last_name" placeholder="Last Name">
				</div>
				<div id="field-wrapper">
					<label for="">Password</label>
					<input type="text" class="inputfield" name="password" placeholder="Password">
				</div>
				<div id="field-wrapper">
					<label for="">Phonenumber</label>
					<input type="text" class="inputfield" name="phone" placeholder="Phonenumber">
				</div>
				<div id="field-wrapper">
					<label for="">Street</label>
					<input type="text" class="inputfield" name="street" placeholder="Street">
				</div>
				<div id="field-wrapper">
					<label for="">Postalcode</label>
					<input type="text" class="inputfield" name="postal_code" placeholder="Postal Code">
				</div>
				<div id="field-wrapper">
					<label for="">City</label>
					<input type="text" class="inputfield" name="city" placeholder="City">
				</div>
					<!-- <input type="text" class="" name="country" placeholder="Country"> -->
					
					<!-- <label for="country">Välj land</label> <br> -->
				<div id="field-wrapper">
					<label for="">Choose Country</label>
					<select class="inputfield" name="country" id="country">
						<option name="sweden" value="Sweden">Sweden</option>
						<option name="Norway" value="Norway">Norway</option>
						<option name="Denmark" value="Denmark">Denmark</option>
						<option name="Finland" value="Finland">Finland</option>
					</select>
				</div>

				<div class="long">
					<label for="">E-mail</label>
					<input type="text" class="inputfield" name="email" placeholder="E-mail">
				</div>
				<div class="buttons">
					<input class="add-user-btn" type="submit" name="addUserBtn" value="Add">
				</div>
			</form>
		</div>
	</section>

	<section class="manage-users-section">
	<h1 class="rubrik">Manage users</h1>
		<table id="user-table">
			<thead>
				<tr>
					<th>Namn</th>
					<th>Email</th>
					<th>ID</th>
					<th>Phone</th>
					<th>Adress</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</section>
	<script src="js/useradmin.js"></script>


</body>
</html>

<?php include('../layout/footer.php'); ?>
