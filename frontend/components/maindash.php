<?php
require_once('db_connector.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $operation = $_POST["operation"];

    // if($operation === "Edit"){
    //   if (isset($_POST['name']) && isset($_POST['message']) && isset($_POST['color']) && isset($_POST['id'])) {
            
    //     $name = $_POST['name'];
    //     $message = $_POST['message'];
    //     $color = $_POST['color'];
    //     $currentDate = date("Y-m-d");
    //     $status = "New";
    //     $id = $_POST['id'];

    //     $sql = "UPDATE note_tbl SET note_name = '$name',note_message = '$message', note_color = '$color', note_date = '$currentDate', note_status = '$status' WHERE note_id = '$id'";

    //       if ($connection->query($sql) === TRUE) {
    //       } else {
    //         $connection->error;
    //       }
    //     } 
    // }

    // if($operation === "Add"){
    //   if (isset($_POST['name']) && isset($_POST['message']) && isset($_POST['color'])) {
      
    //     $name = $_POST['name'];
    //     $message = $_POST['message'];
    //     $color = $_POST['color'];
    //     $currentDate = date("Y-m-d");
    //     $status = "New";

    //     $sql = "INSERT INTO note_tbl (note_name, note_date, note_message, note_color, note_status) VALUES ('$name' , '$currentDate','$message', '$color ', '$status')";
    //     $result = $connection->query($sql);
    //     $connection->close();
    //   } 
    // }
    


    // if (isset($_POST['noteIdStat']) && isset($_POST['status'])) {
      
    //   $id = $_POST['noteIdStat'];
    //   $status = $_POST['status'];

    //    $sql = "UPDATE note_tbl SET note_status = '$status' WHERE note_id = '$id'";

    //     if ($connection->query($sql) === TRUE) {
    //     } else {
    //         $connection->error;
    //     }
    // } 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/mainDash.css">
    <title>Document</title>
</head>
<body>

<div class="dashboardContainer">
    <div class="sidebar">
        <div class="logo">
            <h1>Note<span id="spanLogo">It!</span></h1>
        </div>
        <div class="listContainer">
            <ul>
                <li > <img width="30" height="30" src="images/notes.png" alt=""> All Notes</li>
                <li> <img width="30" height="30" src="images/heart.png" alt=""> Favorites</li>
                <li> <img width="30" height="35" src="images/archive.png" alt=""> Archives</li>
                <li> <img width="30" height="30" src="images/logout.png" alt=""> Logout</li>
            </ul>
        </div>
    </div>
    <div class="dashboardContent">
        <div class="topBar">
            <div class="titleNotes">
                <h1 class="allNotes">All Notes</h1>
                <div class="line"></div>
            </div>
            <div class="searchNav">
                <input id="searchNotes" type="text" placeholder="Search" name = "searchName">
            </div>
            <div class="addBtn">
                <button id="addNotesBtn">+</button>
                <label for="" id = "addNtsLbl">Add Notes</label>
            </div>
        </div>
        <div class="notesContainer" id = "notesContainer">
            <div id="popupForm" class="popup-form">

                <div class="notesFormContainer" id = "notesFormContainer">

                  <h2 id="titleForm">Add Notes</h2><br>
                    <form action="" method="post" id="notesForm">

                        <label for="" id = "notesNameLbl">Notes Name:</label><br><br>
                        <input type="text" id = "operation" hidden>
                        <input type="text" id = "idDisplay" hidden>
                        <input id="notesName" type="text" placeholder="Untitled Notes">
                        <p id = "noteMsgOut" contenteditable="true" class="messageCont">
                    </form>
                    <div class="buttonContainer">
                        <button id="addBtn">Add Notes</button>
                        <button id="cnlBtn" onclick = "resetForm()">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="addedNoteContainer" id="addedNoteContainer">
              
              <?php
                  require_once('db_connector.php');

                  if (isset($_POST['query'])){
                    $search = $_POST["query"];
                    $sql = "SELECT * FROM note_tbl WHERE (note_status = 'New' OR note_status = 'Favorite') AND (note_name LIKE '%$search%')";
                  } else {
                    $sql = "SELECT * FROM note_tbl WHERE note_status = 'New' OR note_status = 'Favorite'";
                  }
                  $result = $connection->query($sql);

                  if(!$result){
                      die("Invalid query: ". $connection->error);
                  }

                  while($row = $result->fetch_assoc()){
                    
                      if($row["note_status"] === 'New'){
                        $path = 'images/notFav.png';
                        $height = "60";
                        $width = "60";
                        $marginTop = "-50px";
                        $marginLeft = "60px";
                        $trashMarginTop = "-58px";
                        $alt = "New";
                        $name = "Add to Favorite"; 
                      }else if($row["note_status"] === 'Favorite'){
                        $path = 'images/favorite.PNG';
                        $height = "45";
                        $width = "40";
                        $marginTop = "-45px";
                        $marginLeft = "70px";
                        $trashMarginTop = "-50px";
                        $alt = "Favorite";
                        $name = "Remove Favorite"; 
                      }
                      echo "
                      <div class = 'newNote' id = 'newNote'>
                        <h2 class='noteName'>$row[note_name]</h2>
                        <div class='imgCont'>
                          <img class='dotsImg' width='20' height='20'src='images/dots.PNG'>
                          <ul id = 'menu-list' class='menu-list' style='display: none;'>
                              <li data-noteId = '$row[note_id]' data-name = '$row[note_name]' data-color = '$row[note_color]'
                              data-message = '$row[note_message]'
                              data-date = '$row[note_date]' class='editBtn' id = 'editBtn' onclick = 'editNotes()'>Edit</li>
                              <li id = 'listFav' class='favNote' alt = $alt onclick = 'favToggle($row[note_id])'>$name  </li>
                              <li>Archive</li>
                              <li>Delete Permanent</li>
                          </ul>
                        </div>
                        <div class = 'messageContainer' id = 'messageContainer' >
                          <p data-noteId = '$row[note_id]' data-name = '$row[note_name]' data-color = '$row[note_color]' data-message = '$row[note_message]' data-date = '$row[note_date]' onclick = 'editNotes()' class='editBtn' id = 'noteMessage'>$row[note_message]</p>
                        </div>
                        <div class = 'buttonContainers'>
                          <div class = 'dateContainer'>
                            <h5>$row[note_date]</h5>
                          </div>
                        </div>
                      
                      </div>
                      ";
                  }
                ?>
            </div>
        </div>
    </div>
</div>

<script>

    let container = document.getElementById("popupForm");
     
    document.getElementById('searchNotes').addEventListener('input', function() {
      search(this.value);
    });

    function search(query) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '', true); // Provide the correct URL of search.php
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          updateNotes(xhr.responseText);
        }
      };
      xhr.send('query=' + query);
    }

    function updateNotes(responseText) {
      // Parse the responseText as HTML
      const parser = new DOMParser();
      const newNotes = parser.parseFromString(responseText, 'text/html').body.querySelectorAll('.newNote');

      // Get the target container
      const container = document.getElementById('addedNoteContainer');

      // Remove existing notes from the container
      container.innerHTML = '';

      // Append new notes to the container
      newNotes.forEach(function(newNote) {
          container.appendChild(newNote);
      });
    }

    function resetForm() {
      const noteName = document.getElementById('notesName');
      const noteMessage = document.getElementById("noteMsgOut");
      noteName.value = '';
      noteMessage.textContent = '';
      formTitle.textContent = "ADD NOTES";
      noteForm.style.display = "none";
      addBtn.textContent = "Add Notes";
    }

    function editNotes(){
      let container = document.getElementById("popupForm");
      let form = document.getElementById("popupForm");
      let nameInput = document.getElementById("notesName");
      let messageInput = document.getElementById("noteMsgOut");
      let colorInput = document.getElementById("themePick");
      let idInput = document.getElementById("notesName");

      let id = "";
      let name = "";
      let message = "";
      let color = "";

      if (event.target.classList.contains("editBtn")) {
         id = event.target.getAttribute('data-noteId');
         name = event.target.getAttribute('data-name');
         message = event.target.getAttribute('data-message');
         color = event.target.getAttribute('data-color');
      }
      nameInput.value = name;
      messageInput.textContent = message;
      colorInput.style.backgroundColor = color;
      colorInput.value = color;
      container.style.backgroundColor = color;
      form.style.display = "block";
      titleForm.textContent = "Notes";
      addBtn.textContent = "Save";
      idDisplay.value = id;
      operation.value = "Edit";
      
      let mode = "";

      if (color.includes("red") || color.includes("green") || color.includes("blue")) {
        mode = "dark";
      }else if(color.includes("white") || color.includes("yellow")){
        mode = "light";
      }
      changeColor(color, mode);
    }


    document.addEventListener("DOMContentLoaded", function() {
      
      let dotsBtn = document.querySelectorAll(".imgCont");
      let editBtn = document.querySelectorAll(".editBtn");
      var addBtn = document.getElementById("addBtn");
      var cnlBtn = document.getElementById("cnlBtn");
      let pickBtn = document.getElementById("themePick");
      let favBtn = document.querySelectorAll(".favNote");
      let outThemeBtn = document.querySelectorAll(".themeBtn");

      dotsBtn.forEach(function(btn) {
        btn.addEventListener('click', function() {
          let menuList = btn.querySelector('.menu-list');
          menuList.style.display = menuList.style.display === 'block' ? 'none' : 'block';
        });
      });
    });

    let noteForm = document.getElementById("popupForm");
    let btn = document.getElementById("addNotesBtn");
    let formTitle = document.getElementById("titleForm");
    
    btn.addEventListener("click", function(){
      formTitle.textContent = "ADD NOTES";
      noteForm.style.display = "Block";
    });

    cnlBtn.addEventListener("click", function(){
      noteForm.style.display = "none";
    });



</script>

</body>
</html>