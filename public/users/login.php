<?php 
    require('../../src/config.php');

    $errorMessages = "";
    $email = "";
    $deletedUser = "";
    $logout = "";
    $mustLogin = "";
    $incorrectLogin = "";

    if (isset($_GET['deletedUser'])) {
        $deletedUser = "User deleted";
    }

    if (isset($_GET['logout'])) {
        $logout = "User logged out";
    }

    if (isset($_GET['mustLogin'])) {
        $mustLogin = "Please login to access this page";
    }

    if (isset($_POST['loginBtn'])) {

        if (empty($_POST['email'])) {
            $errorMessages .= "Please enter your email<br>";
        } else {
            $email = trim($_POST['email']);
        }
        
        if (empty($_POST['password'])) {
            $errorMessages .= "Please enter your password<br>";
        } else {
            $password = trim($_POST['password']);
        }

        if(empty($errorMessages)) {
            
            $user = $usersDbHandler->fetchUserByEmail($email);
    
            if ($user && password_verify($password, $user['password'])) {
                // set login session
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                redirect('my-page.php');
                exit;
            } else {
                $incorrectLogin = "The username or password you entered is incorrect";
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
        <p id="success" class="alert alert-success" role="alert"><?=$deletedUser?></p>
        <p id="success" class="alert alert-success" role="alert"><?=$logout?></p>
        <p id="error" class="alert alert-danger" role="alert"><?=$mustLogin?></p>
        <p id="error" class="alert alert-danger" role="alert"><?=$incorrectLogin?></p>
        <p id="error" class="alert alert-danger" role="alert"><?=$errorMessages?></p>
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
        <a href="my-page.php">My page</a>
    </div>
</body>
</html>