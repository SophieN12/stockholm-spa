<?php 
require('../../../src/config.php');
$pageTitle = "Update user";

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
// Update user with validation
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
	}
}


//fetch specific user
// $sql = "
//     SELECT * FROM users
//     WHERE id =:id
// ";

// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':id', $_GET['userId']);
// $stmt->execute();

$user = $useradminDbHandler->fetchSpecificUser();

?>

<?php include('../layout/header.php'); ?>

<div class="update-user-form">
    <h3 class="rubrik">Uppdatera inlägg</h3>

    <?=$message ?>

    <!-- nytt posts steg 2 -->
    <form action="" method="POST">
        <div>
            <input type="text" class="" name="first_name" placeholder="First Name" value="<?=htmlentities($user['first_name'])?>">
            <input type="text" class="" name="last_name" placeholder="Last Name" value="<?=htmlentities($user['last_name'])?>">
            <input type="text" class="" name="email" placeholder="E-mail" value="<?=htmlentities($user['email'])?>">
            <input type="text" class="" name="password" placeholder="Password" value="<?=htmlentities($user['password'])?>">
            <input type="text" class="" name="phone" placeholder="Phonenumber" value="<?=htmlentities($user['phone'])?>">
            <input type="text" class="" name="street" placeholder="Street" value="<?=htmlentities($user['street'])?>">
            <input type="text" class="" name="postal_code" placeholder="Postal Code" value="<?=htmlentities($user['postal_code'])?>">
            <input type="text" class="" name="city" placeholder="City" value="<?=htmlentities($user['city'])?>">
            <!-- <input type="text" class="" name="country" placeholder="Country" value="<?=htmlentities($user['country'])?>"> -->

            <label for="country">Välj land</label>
            <select name="country" id="country" value="<?=htmlentities($user['country'])?>">
                <option selected><?=htmlentities($user['country'])?></option>
                <option name="sweden" value="Sweden">Sweden</option>
                <option name="Norway" value="Norway">Norway</option>
                <option name="Denmark" value="Denmark">Denmark</option>
                <option name="Finland" value="Finland">Finland</option>
            </select>

            <div class="buttons">
                <input type="submit" name="updateUserBtn" value="Uppdatera"class="update-btn"> 
                <a class="back-link" href="useradmin.php">Tillbaka</a>
            </div>  
        </div>
    </form>
</div>

<?php include('../layout/footer.php'); ?>