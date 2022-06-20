<?php 
    require('../../src/config.php');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/user-form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Create new user</title>
</head>
<body>
    <div id="container">
        <h1>Create new user</h1>
        <p id="successMessage"></p>
        <form id="add-user-form" action="" method="POST">
            <div id="form-inputs">
                <div id="left-side-form">
                    <label for="first_name">First Name*</label><br>
                    <input type="text" name="first_name"><br>
                    <p id="first-name-error"></p>
                    
                    <label for="last_name">Last Name*</label><br>
                    <input type="text" name="last_name"><br>
                    <p id="last-name-error"></p>
                    
                    <label for="email">Email*</label><br>
                    <input type="text" name="email"><br>
                    <p id="email-error"></p>
                    <p id="email-error2"></p>
    
                    <label for="password">Password*</label><br>
                    <input type="password" name="password"><br>
                    <p id="password-error"></p>
                    
                    <label for="confirmPassword">Confirm password*</label><br>
                    <input type="password" name="confirmPassword"><br>
                    <p id="confirmPassword-error"></p>
                </div>
                <div id="right-side-form">
                    <label for="street">Street*</label><br>
                    <input type="text" name="street"><br>
                    <p id="street-error"></p>
                    
                    <label for="postal_code">Postal Code*</label><br>
                    <input type="text" name="postal_code"><br>
                    <p id="postal_code-error"></p>
                    
                    <label for="phone">Phone number*</label><br>
                    <input type="text" name="phone"><br>
                    <p id="phone-error"></p>
                    
                    <label for="city">City*</label><br>
                    <input type="text" name="city"><br>
                    <p id="city-error"></p>
                    
                    <label for="country">Country*</label><br>
                    <select name="country" id="country">
                        <option disabled selected value> Select a country</option>
                        <option value="SE">Sweden</option>
                        <option value="NO">Norway</option>
                        <option value="DK">Denmark</option>
                        <option value="FI">Finland</option>
                    </select><br><br>
                    <p id="country-error"></p>
                </div>
            </div>
            <input id="submitBtn" type="submit" name="createBtn" value="Create" id="submitBtn">
        </form><br>
        <a href="login.php">Login page</a><br><br>
        <a href="../index.php">&#8592 Back</a>
    </div>
    <script src="js/add-user.js"></script>
</body>
</html>