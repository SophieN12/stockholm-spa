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
    $errorMessages      = "";

    if (isset($_POST['createBtn'])) {
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

            if (empty($_POST['password'])) {
                $errorMessages .= "Please enter a password<br>";
            } else {
                $password = trim($_POST['password']);
            }

            if (empty($_POST['confirmPassword'])) {
                $errorMessages .= "Please confirm your password<br>";
            } else {
                if ($_POST['password'] !== $confirmPassword) {
                    $errorMessages .= "Confirmed password incorrect!<br>";
                }
            }
        
            // If no errors then create user in database
            if(empty($errorMessages)) {
                try {
                    $usersDbHandler->createUser (
                        $first_name, $last_name, $email, $password, $phone, 
                        $street, $postal_code, $city, $country);
                    
                    $successMessage = "User succesfully created!";
                } catch (\PDOException $e ){
                    if ((int) $e->getCode() === 23000) {
                        $errorMessages .= "Email address already registred, please enter a different email";
                    } else {
                        throw new \PDOException($e->getMessage(), (int) $e->getCode());
                    }
                }
            }
    }

    $data = [
        'successMessage' => $successMessage,
        'errorMessages' => $errorMessages
    ];
    
    echo json_encode($data);



        