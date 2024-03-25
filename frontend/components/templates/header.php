<link rel="stylesheet" href="styles/header.css">
<body>
<div class = "header">
    <div class = "logo">
        <h1>Note<span id = "spanLogo">It!</span></h1>
    </div>
    <div class = "links">
        <h5 id = "links" onclick = "changePage('http://localhost/note/frontend/components/index.php')">HOME</h5>
        <h5 id = "links" onclick = "changePage('http://localhost/note/frontend/components/register.php')">REGISTER</h5>
        <h5 id = "links" onclick = "changePage('http://localhost/note/frontend/components/loginPage.php')">SIGN IN</h5>
    </div>

    

</div>

<script>

    function changePage(link){
        window.location.href = link;
    }

</script>