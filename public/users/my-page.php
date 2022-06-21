<?php 
    require('../../src/config.php');

    if (!isset($_SESSION['email'])) {
        redirect('login.php?mustLogin');
    }

    $errorMessages = "";

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
    $emailError         = "";

    if (isset($_POST['deleteBtn'])) {
        $usersDbHandler->deleteUser();
        destroySession();
        redirect('login.php?deletedUser');
    }

    if (isset($_POST['updateBtn'])) {
        $confirmPassword = trim($_POST['confirmPassword']);

        if (empty($_POST['first_name'])) {
            $errorMessages .= "Please enter your first name<br>";
        } else {
            $first_name = trim($_POST['first_name']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['first_name'])) {
                $errorMessages .= "Special characters in 'First name' are not allowed, please try again<br>";
            };
        }

        if (empty($_POST['last_name'])) {
            $errorMessages .= "Please enter your last name<br>";
        } else {
            $last_name = trim($_POST['last_name']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['last_name'])) {
                $errorMessages .= "Special characters in 'Last name' are not allowed, please try again<br>";
            };
        }

        if (empty($_POST['street'])) {
            $errorMessages .= "Please enter your address<br>";
        } else {
            $street = trim($_POST['street']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['street'])) {
                $errorMessages .= "Special characters in 'Street' are not allowed, please try again<br>";
            };
        }

        if (empty($_POST['postal_code'])) {
            $errorMessages .= "Please enter your postcode<br>";
        } else {
            $postal_code = trim($_POST['postal_code']);
            if (!is_numeric($postal_code)) {
                $errorMessages .= "Must only contain numbers, please try again<br>";
            }
        }

        if (empty($_POST['city'])) {
            $errorMessages .= "Please enter your city<br>";
        } else {
            $city = trim($_POST['city']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['city'])) {
                $errorMessages .= "Special characters in 'City' are not allowed, please try again<br>";
            };
        }

        if (empty($_POST['country'])) {
            $errorMessages .= "Please choose your country<br>";
        } else {
            $country = $_POST['country'];
        }

        if (empty($_POST['phone'])) {
            $errorMessages .= "Please enter your phone number<br>";
        } else {
            $phone = trim($_POST['phone']);
            if (!is_numeric($phone)) {
                $errorMessages .= "'Phone' must only contain numbers, please try again<br>";
            }
        }

        if (empty($_POST['email'])) {
            $errorMessages .= "Please enter your email<br>";
        } else {
            $email = trim($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessages .= "Not a valid email, please try again<br>";
            }
        }

        if (empty($_POST['newPassword'])) {
            $encryptedPassword = $_SESSION['password'];
        } else {
            $encryptedPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT, ['cost' => 12]);
        }

        if ($_POST['newPassword'] !== $confirmPassword) {
            $errorMessages .= "Confirmed password incorrect!<br>";
        }

        // If no errors then update user in database
        if(empty($errorMessages)) {
            try {
               $usersDbHandler->updateUser (
                   $first_name, $last_name, $email, $encryptedPassword, $phone, 
                   $street, $postal_code, $city, $country);
                
                $successMessage = "User succesfully updated!";
            } catch (\PDOException $e ){
                if ((int) $e->getCode() === 23000) {
                    $errorMessages .= "Email address already registred, please enter a different email";
                } else {
                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
                }
            }
        }
    }

    $user = $usersDbHandler->fetchUserByEmail ($_SESSION['email']);
?>

<!DOCTYPE html>
<html>

<?php include('../layout/header.php'); ?>

<head>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/user-form.css">
    <title>My page</title>
</head>
<body>
    <div id="container">
        <h1>My page</h1>
        <h3>Update user information</h3><br>
        <p id="success"><?=$successMessage?></p>
        <p id="error"><?=$errorMessages?></p>
        <form action="" method="POST">
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
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?=htmlentities($_SESSION['id'])?>">
                <input id="deleteBtn" type="submit" name="deleteBtn" value="Delete">
            </form>
        <a href="logout.php">Logout</a>
    </div>
</body>

<?php include('../layout/footer.php'); ?>

</html>