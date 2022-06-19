<?php 
    require('../../src/config.php');

    $errorMessages = array('email'=>"", 'password'=>"");
    $email = "";
    $deletedUser = "";
    $logout = "";
    $mustLogin = "";
    $incorrectLogin = "";

    if (isset($_GET['deletedUser'])) {
        $deletedUser = 
        '<div class="alert alert-danger" role="alert">
            User deleted
        </div>';
    }

    if (isset($_GET['logout'])) {
        $logout = 
        '<div class="alert alert-danger" role="alert">
            User logged out
        </div>';
    }

    if (isset($_GET['mustLogin'])) {
        $mustLogin = 
        '<div class="alert alert-danger" role="alert">
            Please login to access this page
        </div>';
    }

    if (isset($_POST['loginBtn'])) {

        if (empty($_POST['email'])) {
            $errorMessages['email'] = 
            '<div class="alert alert-danger" role="alert">
                Please enter your email
            </div>';
        } else {
            $email = trim($_POST['email']);
        }
        
        if (empty($_POST['password'])) {
            $errorMessages['password'] = '
            <div class="alert alert-danger" role="alert">
                Please enter your password
            </div>';
        } else {
            $password = trim($_POST['password']);
        }

        if(!array_filter($errorMessages)) {
            
            $user = $usersDbHandler->fetchUserByEmail($email);
    
            if ($user && password_verify($password, $user['password'])) {
                // set login session
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                redirect('my-page.php');
                exit;
            } else {
                $incorrectLogin = '
                <div class="alert alert-danger" role="alert">
                    The username or password you entered is incorrect
                </div>';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/general.css">
    <title>Login</title>
</head>
<body>
    <div id="container">
        <h1>Login</h1>
            <p><?=$deletedUser?></p>
            <p><?=$logout?></p>
            <p><?=$mustLogin?></p>
            <p><?=$incorrectLogin?></p>
            <p><?=$errorMessages['email']?></p>
            <p><?=$errorMessages['password']?></p>
        <form action="" method="POST">
            <div id="form-inputs">
                <label for="email">Email*</label><br>
                <input type="text" name="email" value="<?=htmlentities($email)?>"><br><br>
                <label for="password">Password*</label><br>
                <input type="password" name="password"><br>
            </div>
            <input id="submitBtn" type="submit" name="loginBtn" value="Login">
        </form><br>
        <p id="sign-up">Not a member yet? <a id="sign-up-link" href="new-user.php">Sign up here!</a></p>
        <a href="new-user.php">Create new account</a><br><br>
        <a href="my-page.php">My page</a>
    </div>
    <!-- jQuery AND Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>