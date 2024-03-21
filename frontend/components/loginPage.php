
<?php

    include "templates/header.php";

?>
<link rel="stylesheet" href="styles/login.css">

<div class = "loginContainer">
    <div class = "loginTitle">
        <h1 id = "loginTitle">Note<span id = "spanLogo">It!</span></h1>
    </div>
    <div class = "formContainer">
        <form action="">
            <label for="">Username</label><br><br>
            <input class = "nameText" type="text"><br><br>
            <label for="">Password</label><br><br>
            <input class = "passwordText"type="text" ><br><br>
            <input class = "checkbox" type="checkbox">
            <label for="">Sign Me In</label>
            <a class = "forgotPass" href="">Forgot Password?</a><br>
            <button class = "signInBtn">SIGN IN</button>
        </form>
    </div>
</div>


<script>

    let headings = document.querySelectorAll("#links");

    headings.forEach(function(heading) {
        heading.addEventListener("click", function() {
            headings.forEach(function(h) {
                h.classList.remove("active");
            });
            this.classList.add("active");
        });
    });

    </script>
</body>
</html>