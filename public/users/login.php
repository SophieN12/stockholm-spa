<?php 
    require('../../src/config.php');
    $pageTitle = "login";

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
<html>
    
<?php include('../layout/header.php'); ?>
    
<head>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/general.css">
    <title>Login</title>
</head>
<body>
    <div id="container">
        <h1 class="heading">Login</h1>
        <p id="success"><?=$deletedUser?></p>
        <p id="success"><?=$logout?></p>
        <p id="error"><?=$mustLogin?></p>
        <p id="error"><?=$incorrectLogin?></p>
        <p id="error"><?=$errorMessages?></p>
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
    </div>
</body>

<?php include('../layout/footer.php'); ?>

</html>