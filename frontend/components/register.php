<?php

    include "templates/header.php";
    require_once('db_connector.php');
    
    $errorFname = "";
    $errorLname = "";
    $errorAge = "";
    $errorGender = "";
    $errorEmail = "";
    $errorPass = "";
    $errorCpass = "";
    $fname = "";
    $lname = "";
    $age = "";
    $gender = "";
    $email = "";
    $password = "";
    $cpassword = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $age = $_POST["age"];
        $gender = isset($_POST["Gender"]);
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $error = false;

        if (!preg_match("/^[a-zA-Z]+$/", $fname)) {
            $error = true;
            $errorFname = "First Name must be string.<br>";
        }

        if(empty($fname)){
            $error = true;
            $errorFname= "First Name must be inputted <br>";
        }else{
            $error = false;
        }

        if (!preg_match("/^[a-zA-Z]+$/", $lname)) {
            $error = true;
            $errorLname = "Last Name must be string.<br>";
        }

        if(empty($lname)){
            $error = true;
            $errorLname = "Last Name must be inputted <br>";
        }else{
            $error = false;
        }

        if(empty($age)){
            $error = true;
            $errorAge = "Age must be inputted.<br>";
        }else{
            $error = false;
        }
        
        if (is_numeric($age)) {
            $error = false;
        }else{
            $error = true;
            $errorAge = "Invalid Age. <br>";
        }

        if(isset($_POST["Gender"])){
            $gender = $_POST["Gender"];
        }else{
            $gender = "";
        }

        if (empty($gender)) {
            $error = true;
            $errorGender = "Pick Gender";
        }
         
        $pattern = '/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/';

        if (!preg_match($pattern, $email)) {
            $error = true;
            $errorEmail = "Email must be valid.<br>";
        }

        if (!preg_match("/[A-Z]/", $password)) {
            $error = true;
            $errorPass = "Password must contain at least one capital letter.<br>";
        }

        if (!preg_match("/[^a-zA-Z0-9]/", $password)){ 
            $error = true;
            $errorPass = "Password must contain at least one special character.<br>";
        }

        if (empty($password)) {
            $error = true;
            $errorPass = "Enter Password";
        }

        if($cpassword !== $password){
            $error = true;
            $errorCpass = "Password not match";
        }

        if (empty($cpassword)) {
            $error = true;
            $errorCpass = "Re-enter Password";
        }

        if($error === false){

            $sqlSelect = "SELECT * FROM users WHERE user_email = '$email'";
                  
            $resultSelect = $connection->query($sqlSelect);

            if ($resultSelect->num_rows > 0){
                $errorEmail = "Email is already exist.<br>";
            }else{
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (user_fname, user_lname, user_age, user_gender, user_email, user_password) VALUES ('$fname' , '$lname','$age', '$gender ', '$email', '$hashedpassword')";
                $result = $connection->query($sql);
                $fname = "";
                $lname = "";
                $age = "";
                $gender = "";
                $email = "";
                $password = "";
                $cpassword = "";
            }
        }


} 

?>

<link rel="stylesheet" href="styles/newregister.css">

<div id = "formContainer">

    <form action="" method = "POST">
        <h3>REGISTRATION FORM</h3><br>
        <div class = "mainDiv">
            <div class = "leftContainer">
                <label for="">First Name:</label><br>
                <input type="text" id = "nameInput" name = "fname" value = <?php echo $fname ?>><br>
                <label for="" id = "fnameError"><?php echo $errorFname ?></label><br>
                 <label for="">Age:</label><br>
                <input type="text" id = "ageInput" name = "age" value = <?php echo $age ?>><br>
                <label for="" id = "ageError"><?php echo $errorAge ?></label><br>
                 <label for="">Email:</label><br>
                <input type="text"id = "emailInput" name = "email" value = <?php echo $email ?>><br>
                <label for="" id = "emailError"><?php echo $errorEmail ?></label><br>
                <label for="">Password:</label><br>
                <input type="text"id = "passwordInput" name = "password" value = <?php echo $password ?>><br>
                <label for="" id = "passwordError"><?php echo $errorPass ?></label><br>
            </div>
            <div class = "rightContainer">
                <label for="">Last Name:</label><br>
                <input type="text" id = "lastName" name = "lname" value = <?php echo $lname ?>><br>
                <label for="" id = "lnameError"><?php echo $errorLname ?></label><br>
                <label for="">Gender:</label><br>
                <input type="radio" name = "Gender" value = "Male">
                <label for="" >Male:</label>
                <input type="radio" name = "Gender" value = "Female">
                <label for="" >Female:</label><br>
                <label for="" id = "genderError"><?php echo $errorGender ?></label><br><br><br><br><br>
                <label for="">Confirm Password:</label><br>
                <input type="text"id = "confirmpasswordInput" name = "cpassword" value = <?php echo $cpassword ?>><br>
                <label for="" id = "cpasswordError"><?php echo $errorCpass ?></label><br>
            </div>
        </div>
        <button id="button">Submit</button>

    </form>

</div>


</body>
</html>