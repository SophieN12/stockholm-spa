<?php 
    require('../../src/dbconnect.php');

    $errorMessages = array(
        'first_name'=>"", 
        'last_name'=>"", 
        'street'=>"", 
        'postal_code'=>"", 
        'city'=>"", 
        'country'=>"",
        'phone'=>"", 
        'email'=>"", 
        'password'=>"",
        'confirmPassword'=>"",
        'emailError'=>""
    );

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

    if (isset($_POST['createBtn'])) {
        $confirmPassword = $_POST['confirmPassword'];

        if (empty($_POST['first_name'])) {
            $errorMessages['first_name'] = "Please enter your first name";
        } else {
            $first_name = trim($_POST['first_name']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['first_name'])) {
                $errorMessages['first_name'] = "Special characters are not allowed, please try again";
            };
        }
    
        if (empty($_POST['last_name'])) {
            $errorMessages['last_name'] = "Please enter your last name";
        } else {
            $last_name = trim($_POST['last_name']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['last_name'])) {
                $errorMessages['last_name'] = "Special characters are not allowed, please try again";
            };
        }

        if (empty($_POST['street'])) {
            $errorMessages['street'] = "Please enter your address";
        } else {
            $street = trim($_POST['street']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['street'])) {
                $errorMessages['street'] = "Special characters are not allowed, please try again";
            };
        }

        if (empty($_POST['postal_code'])) {
            $errorMessages['postal_code'] = "Please enter your postcode";
        } else {
            $postal_code = trim($_POST['postal_code']);
            if (!is_numeric($postal_code)) {
                $errorMessages['postal_code'] = "Must only contain numbers, please try again";
            }
        }

        if (empty($_POST['city'])) {
            $errorMessages['city'] = "Please enter your city";
        } else {
            $city = trim($_POST['city']);
            if(preg_match('/[\^£$%&"*()}{@#~?><>,|=_+¬]/', $_POST['city'])) {
                $errorMessages['city'] = "Special characters are not allowed, please try again";
            };
        }

        if (empty($_POST['country'])) {
            $errorMessages['country'] = "Please choose your country";
        } else {
            $country = $_POST['country'];
        }

        if (empty($_POST['phone'])) {
            $errorMessages['phone'] = "Please enter your phone number";
        } else {
            $phone = trim($_POST['phone']);
            if (!is_numeric($phone)) {
                $errorMessages['phone'] = "Must only contain numbers, please try again";
            }
        }
    
        if (empty($_POST['email'])) {
            $errorMessages['email'] = "Please enter your email";
        } else {
            $email = trim($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessages['email'] = "Not a valid email, please try again";
            }
        }

        if (empty($_POST['password'])) {
            $errorMessages['password'] = "Please enter a password";
        } else {
            $password = trim($_POST['password']);
        }

        if (empty($_POST['confirmPassword'])) {
            $errorMessages['confirmPassword'] = "Please confirm your password";
        } else {
            if ($_POST['password'] !== $confirmPassword) {
                $errorMessages['confirmPassword'] = "Confirmed password incorrect!";
            }
        }
    
        // If no errors then create user in database
        if(!array_filter($errorMessages)) {
            try {
                $sql = "
                INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country) 
                VALUES (:first_name, :last_name, :email,  :password, :phone, :street, :postal_code, :city, :country)";
                
                $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":first_name", $first_name);
                $stmt->bindParam(":last_name", $last_name);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $encryptedPassword);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":street", $street);
                $stmt->bindParam(":postal_code", $postal_code);
                $stmt->bindParam(":city", $city);
                $stmt->bindParam(":country", $country);
                $stmt->execute();
                
                $successMessage = "User succesfully created!";
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
            } catch (\PDOException $e ){
                if ((int) $e->getCode() === 23000) {
                    $errorMessages['emailError'] = "Email address already registred, please enter a different email";
                } else {
                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new user</title>
</head>
<body>
    <div id="container">
        <h1>Create new user</h1>
        <p id="successMessage"><?=$successMessage?></p>
        <form action="" method="POST">
            <label for="first_name">First Name</label><br>
            <input type="text" name="first_name" value="<?=$first_name?>"><br>
            <p class="error"><?=$errorMessages['first_name'];?></p>
            
            <label for="last_name">Last Name</label><br>
            <input type="text" name="last_name" value="<?=$last_name?>"><br>
            <p class="error"><?=$errorMessages['last_name'];?></p>
            
            <label for="street">Street</label><br>
            <input type="text" name="street" value="<?=$street?>"><br>
            <p class="error"><?=$errorMessages['street'];?></p>
            
            <label for="postal_code">Postal Code</label><br>
            <input type="text" name="postal_code" value="<?=$postal_code?>"><br>
            <p class="error"><?=$errorMessages['postal_code'];?></p>
            
            <label for="email">Email</label><br>
            <input type="text" name="email" value="<?=$email?>"><br>
            <p class="error"><?=$errorMessages['email'];?></p>
            <p class="error"><?=$errorMessages['emailError'];?></p>
            
            <label for="password">Password</label><br>
            <input type="password" name="password" value="<?=$password?>"><br>
            <p class="error"><?=$errorMessages['password'];?></p>
            
            <label for="confirmPassword">Confirm password</label><br>
            <input type="password" name="confirmPassword" value="<?=$confirmPassword?>"><br>
            <p class="error"><?=$errorMessages['confirmPassword'];?></p>
            
            <label for="phone">Phone number</label><br>
            <input type="text" name="phone" value="<?=$phone?>"><br>
            <p class="error"><?=$errorMessages['phone'];?></p>
            
            <label for="city">City</label><br>
            <input type="text" name="city" value="<?=$city?>"><br>
            <p class="error"><?=$errorMessages['city'];?></p>
            
            <label for="country">Country</label><br>
            <select name="country" id="country">
                <option disabled selected value> -- select a country -- </option>
                <option value="SE">Sweden</option>
                <option value="NO">Norway</option>
                <option value="DK">Denmark</option>
                <option value="FI">Finland</option>
            </select><br><br>
            <p class="error"><?=$errorMessages['country'];?></p>
            <input type="submit" name="createBtn" value="Create" id="submitBtn">
        </form>
        <a href="../index.php">&#8592 Back</a>
    </div>
</body>
</html>