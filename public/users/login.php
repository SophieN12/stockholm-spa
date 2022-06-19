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
        $mustLogin = "Please log in to access this page";
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
    <title>Login</title>
</head>
<body>
    <div id="container">
        <h1>Login</h1>
        <p><?=$deletedUser?></p>
        <p><?=$logout?></p>
        <p><?=$mustLogin?></p>
        <p><?=$incorrectLogin?></p>
        <form action="" method="POST">
            <label for="email">Email</label><br>
            <input type="text" name="email" value="<?=htmlentities($email)?>"><br><br>
            <p><?=$errorMessages['email']?></p>
            <label for="password">Password</label><br>
            <input type="password" name="password"><br><br>
            <p><?=$errorMessages['password']?></p>
            <input type="submit" name="loginBtn" value="Log in">
        </form><br>
        <a href="new-user.php">Create new account</a><br><br>
        <a href="my-page.php">My page</a>
    </div>
</body>
</html>