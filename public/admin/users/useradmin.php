<?php
require('../../../src/config.php');
$pageId = "admin";
$pageTitle = "Admin Users";

$message	="";
$successmessage	="";

if(isset($_POST['deleteUserBtn'])){
	$useradminDbHandler->deleteUser();
}

$users = $useradminDbHandler->fetchAllUsers();

?>

<?php include('../layout/header.php'); ?>
<link rel="stylesheet" type=""text/css" href="../css/useradmin.css"/>

<body>

	<section class="new-user-section">

		<div class="new-user-wrapper">

			<h1 class="rubrik">Create new user</h1>
			<div id="form-message" class="error"><?=$message?></div>
			<div id="form-message-success" class="success"><?=$successmessage?></div>

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
