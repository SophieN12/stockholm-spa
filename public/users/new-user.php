<?php 
    require('../../src/config.php');
    $pageTitle = "new-user";

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
?>

<!DOCTYPE html>
<html>

<?php include('../layout/header.php'); ?>

<head>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/user-form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Create new user</title>
</head>
<body>
    <div id="container">
        <h1 class="heading">Create new user</h1>
        <p id="success"><?=$successMessage?></p>
        <p id="error"><?=$errorMessages?></p>
        <form id="add-user-form" action="" method="POST">
            <div id="form-inputs">
                <div id="left-side-form">
                    <label for="first_name">First Name*</label><br>
                    <input type="text" name="first_name"><br>
                    
                    <label for="last_name">Last Name*</label><br>
                    <input type="text" name="last_name"><br>
                    
                    <label for="email">Email*</label><br>
                    <input type="text" name="email"><br>
    
                    <label for="password">Password*</label><br>
                    <input type="password" name="password"><br>
                    
                    <label for="confirmPassword">Confirm password*</label><br>
                    <input type="password" name="confirmPassword"><br>
                </div>
                <div id="right-side-form">
                    <label for="street">Street*</label><br>
                    <input type="text" name="street"><br>
                    
                    <label for="postal_code">Postal Code*</label><br>
                    <input type="text" name="postal_code"><br>
                    
                    <label for="phone">Phone number*</label><br>
                    <input type="text" name="phone"><br>
                    
                    <label for="city">City*</label><br>
                    <input type="text" name="city"><br>
                    
                    <label for="country">Country*</label><br>
                    <select name="country" id="country">
                        <option disabled selected value> Select a country</option>
                        <option value="SE">Sweden</option>
                        <option value="NO">Norway</option>
                        <option value="DK">Denmark</option>
                        <option value="FI">Finland</option>
                    </select><br><br>
                </div>
            </div>
            <input id="submitBtn" type="submit" name="createBtn" value="Create">
        </form><br>
        <a href="login.php" id="login-link">&#8592 Back to login</a><br><br>
    </div>
    <script src="js/add-user.js"></script>
</body>

<?php include('../layout/footer.php'); ?>

</html>