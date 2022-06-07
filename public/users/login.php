<?php 
    session_start();
    require('../../src/dbconnect.php');

    $errorMessages = array('email'=>"", 'password'=>"", 'incorrectLogin'=>"", 'mustLogin'=>"");
    $email = "";

    if (isset($_GET['mustLogin'])) {
        $errorMessages['mustLogin'] = "Please log in to access this page";
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
            $sql = "
                SELECT * FROM users
                WHERE email = :email
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            $user = $stmt->fetch();
    
            if ($user && password_verify($password, $user['password'])) {
                // set login session
                $_SESSION['id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['street'] = $user['street'];
                $_SESSION['postal_code'] = $user['postal_code'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['city'] = $user['city'];
                $_SESSION['country'] = $user['country'];
                header('Location: my-page.php');
                exit;
            } else {
                $errorMessages['incorrectLogin'] = "The username or password you entered is incorrect";
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
        <p><?=$errorMessages['incorrectLogin']?></p>
        <form action="" method="POST">
            <label for="email">Email</label><br>
            <input type="text" name="email" value="<?=htmlentities($email)?>"><br><br>
            <p><?=$errorMessages['email']?></p>
            <label for="password">Password</label><br>
            <input type="password" name="password"><br><br>
            <p><?=$errorMessages['password']?></p>
            <input type="submit" name="loginBtn" value="Log in">
        </form>
        <a href="my-page.php">My page</a>
    </div>
</body>
</html>