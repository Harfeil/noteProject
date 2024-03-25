<?php

    include "templates/header.php";

?>

<link rel="stylesheet" href="styles/register.css">

<div id = "formContainer">

    <form action="" method = "post">

        <label for="">First Name:</label><br>
        <input type="text" id = "nameInput"><br>
        <label for="" id = "fnameError">ERROR</label><br>
        <label for="">Last Name:</label><br>
        <input type="text" id = "lastName"><br>
        <label for="" id = "lnameError">ERROR</label><br>
        <label for="">Age:</label><br>
        <input type="text" id = "ageInput"><br>
        <label for="" id = "ageError">ERROR</label><br><br>
        <label for="">Gender:</label><br>
        <input type="radio">
        <label for="">Male:</label>
        <input type="radio">
        <label for="">Female:</label><br>
        <label for="" id = "genderError">ERROR</label><br>
        <label for="">Email:</label><br>
        <input type="text"id = "emailInput"><br>
        <label for="" id = "emailError">ERROR</label><br>
        <label for="">Password:</label><br>
        <input type="text"id = "passwordInput"><br>
        <label for="" id = "passwordError">ERROR</label><br>
        <label for="">Confirm Password:</label><br>
        <input type="text"id = "confirmpasswordInput"><br>
        <label for="" id = "cpasswordError">ERROR</label><br>
        <button id="button">Submit</button>

    </form>

</div>


</body>
</html>