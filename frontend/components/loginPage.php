<?php
include "templates/header.php";
require_once('db_connector.php');

$emailError = "";
$passwordError = "";
$checkError = "";
$email = "";
$password = "";
$messageError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $check = isset($_POST["checkme"]);
    $error = false;

    if(empty($email)){
        $error = true;
        $emailError = "Email must be inputted <br>";
    } else {
        $error = false;
    }

    if(empty($password)){
        $error = true;
        $passwordError = "Password must be inputted <br>";
    } else {
        $error = false;
    }

    if(empty($check)){
        $error = true;
        $checkError = "Check the checkbox. <br>";
    } else {
        $error = false;
    }

    if($error === false) {
        $sql = "SELECT user_password FROM users WHERE user_email = '$email'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedpassword = $row["user_password"];
            echo $password;
            if(password_verify($password, $row["user_password"])) {
                header("Location: maindash.php");
            } else {
                $messageError = "Incorrect Password";
            }
        } else {
            $messageError = "User not found";
        }
    }
}
?>
<link rel="stylesheet" href="styles/myLogin.css">

<div class = "loginContainer">
    <div class = "loginTitle">
        <h1 id = "loginTitle">Note<span id = "spanLogo">It!</span></h1>
    </div>
    <div class = "formContainer">
        <form action="" method = "post">
            <label for="">Email:</label><br><br>
            <input class = "nameText" type="text" name = "email" value = <?php echo $email ?>><br><br>
            <label for="" id = "emailError"><?php echo $emailError ?></label><br>
            <label for="">Password</label><br><br>
            <input class = "passwordText"type="text" name = "password"  value = <?php echo $password ?>><br><br>
            <label for="" id = "passwordError"><?php echo $passwordError ?></label><br>
            <input id = "checkbox" type="checkbox" name = "checkme">
            <label for="">Sign Me In</label>
            <a class = "forgotPass" href="forgot_password.php">Forgot Password?</a><br>
            <label for="" id = "checkError"><?php echo $checkError ?></label>
            <button class = "signInBtn">SIGN IN</button>
            <label for="" id = "passwordError"><?php echo $messageError ?></label>
        </form>
    </div>
</div>
</body>
</html>