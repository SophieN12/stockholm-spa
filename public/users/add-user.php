<?php
    require('../../src/config.php');

    $errorMessages = declareErrorMessages ();
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

    if (isset($_POST['createBtn'])) {
            $confirmPassword = trim($_POST['confirmPassword']);

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
                    $usersDbHandler->createUser (
                        $first_name, $last_name, $email, $password, $phone, 
                        $street, $postal_code, $city, $country);
                    
                    $successMessage = "User succesfully created!";
                } catch (\PDOException $e ){
                    if ((int) $e->getCode() === 23000) {
                        $errorMessages['emailError'] = "Email address already registred, please enter a different email";
                    } else {
                        throw new \PDOException($e->getMessage(), (int) $e->getCode());
                    }
                }
            }
    }

    $data = [
        'successMessage' => $successMessage,
        'first_name-error' => $errorMessages['first_name'],
        'last_name-error' => $errorMessages['last_name'],
        'street-error' => $errorMessages['street'],
        'postal_code-error' => $errorMessages['postal_code'],
        'city-error' => $errorMessages['city'],
        'country-error' => $errorMessages['country'],
        'phone-error' => $errorMessages['phone'],
        'email-error' => $errorMessages['email'],
        'password-error' => $errorMessages['password'],
        'confirmPassword-error' => $errorMessages['confirmPassword'],
        'email-error2' => $errorMessages['emailError']
    ];
    
    echo json_encode($data);



        