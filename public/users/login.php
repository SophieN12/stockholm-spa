<?php 
    require('../../src/config.php');

    $errorMessages = array('email'=>"", 'password'=>"");
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
            $errorMessages['email'] = "Please enter your email";
        } else {
            $email = trim($_POST['email']);
        }
        
        if (empty($_POST['password'])) {
            $errorMessages['password'] = "Please enter your password";
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
    <title>Login</title>
</head>
<body>
    <div id="container">
        <h1>Login</h1>
        <div class="alert alert-danger" role="alert">
            <p><?=$deletedUser?></p>
            <p><?=$logout?></p>
            <p><?=$mustLogin?></p>
            <p><?=$incorrectLogin?></p>
            <p><?=$errorMessages['email']?></p>
            <p><?=$errorMessages['password']?></p>
        </div>
        <form action="" method="POST">
            <div id="form-inputs">
                <label for="email">Email*</label><br>
                <input type="text" name="email" value="<?=htmlentities($email)?>"><br><br>
                <label for="password">Password*</label><br>
                <input type="password" name="password"><br>
            </div>
            <input id="loginBtn" type="submit" name="loginBtn" value="Login">
        </form><br>
        <p id="sign-up">Not a member yet? <a id="sign-up-link" href="new-user.php">Sign up here!</a></p>
        <a href="new-user.php">Create new account</a><br><br>
        <a href="my-page.php">My page</a>
    </div>
</body>
</html>