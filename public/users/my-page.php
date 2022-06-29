<?php 
    require('../../src/config.php');
    $pageTitle = "my-page";

    if (!isset($_SESSION['email'])) {
        redirect('login.php?mustLogin');
    }

    $first_name         = "";
    $last_name          = "";
    $street             = "";
    $postal_code        = "";
    $city               = "";
    $country            = "";
    $email              = "";
    $phone              = "";
    $password           = "";
    $confirmPassword    = "";
    $successMessage     = "";
    $errorMessages      = "";

    if (isset($_POST['deleteBtn'])) {
        $usersDbHandler->deleteUser();
        destroySession();
        redirect('login.php?deletedUser');
    }

    $user = $usersDbHandler->fetchUserByEmail ($_SESSION['email']);
?>

<!DOCTYPE html>
<html>

<?php include('../layout/header.php'); ?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/user-form.css">
    <title>My page</title>
</head>
<body>
    <div id="container">
        <h1 class="heading">My page</h1>
        <h3 class="subheading">Update user information</h3><br>
        <p id="success"><?=$successMessage?></p>
        <p id="error"><?=$errorMessages?></p>
        <form id="update-user-form" action="" method="POST">
            <div id="form-inputs">
                <div id="left-side-form">
                    <label for="first_name">First Name</label><br>
                    <input type="text" name="first_name" value="<?=htmlentities($user['first_name'])?>"><br>
                    
                    <label for="last_name">Last Name</label><br>
                    <input type="text" name="last_name" value="<?=htmlentities($user['last_name'])?>"><br>
                    
                    <label for="email">Email</label><br>
                    <input type="text" name="email" value="<?=htmlentities($user['email'])?>"><br>
    
                    <label for="newPassword">New password</label><br>
                    <input type="password" name="newPassword" value=""><br>
                    
                    <label for="confirmPassword">Confirm new password</label><br>
                    <input type="password" name="confirmPassword" value=""><br>
                </div>
                <div id="right-side-form">
                    <label for="street">Street</label><br>
                    <input type="text" name="street" value="<?=htmlentities($user['street'])?>"><br>
                    
                    <label for="postal_code">Postal Code</label><br>
                    <input type="text" name="postal_code" value="<?=htmlentities($user['postal_code'])?>"><br>
                    
                    <label for="phone">Phone number</label><br>
                    <input type="text" name="phone" value="<?=htmlentities($user['phone'])?>"><br>
                    
                    <label for="city">City</label><br>
                    <input type="text" name="city" value="<?=htmlentities($user['city'])?>"><br>
                    
                    <label for="country">Country</label><br>
                    <select name="country" id="country">
                        <option disabled selected value> -- select a country -- </option>
                        <option value="SE" <?php echo ($user['country'] == "SE") ? 'selected' : '';?>>Sweden</option>
                        <option value="NO" <?php echo ($user['country'] == "NO") ? 'selected' : '';?>>Norway</option>
                        <option value="DK" <?php echo ($user['country'] == "DK") ? 'selected' : '';?>>Denmark</option>
                        <option value="FI" <?php echo ($user['country'] == "FI") ? 'selected' : '';?>>Finland</option>
                    </select><br><br>
                </div>
            </div>
                <input id="submitBtn" type="submit" name="updateBtn" value="Update" id="submitBtn">
            </form><br>
            <input id="logoutBtn" type="button" onClick="location.href='logout.php'" value="Logout"><br>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?=htmlentities($_SESSION['id'])?>">
                <input id="deleteBtn" type="submit" name="deleteBtn" value="Delete">
            </form>
    </div>
    <script src="js/update-user.js"></script>
</body>

<?php include('../layout/footer.php'); ?>

</html>