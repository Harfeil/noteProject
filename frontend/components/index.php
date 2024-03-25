<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/landing.css">
    <title>Document</title>
</head>
<body>
<?php

    include "templates/header.php";

?>
    <div class = "contents">
        <div class = "imgContainer">
            <img src="images/landing.PNG" alt="">
        </div>
        <div class = "contentText">
            <div class = "text">
                <h1>Note<span id = "spanLogo">It!</span></h1>
            </div>
            <div class = "bodyText">
                <p>Meet NoteIt!, the modernized app that makes note-taking a breeze. Jot down ideas effortlessly, organize them with ease, and retrieve information lightning-fast. Its customized formatting options and ideal sharing capabilities make NoteIt! an  indispensable tool for maximizing your efficiency.</p>
            </div>
            <button>SIGN IN</button>
        </div>
    </div>

    <script>

        var headings = document.querySelectorAll("#links");

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