# noteProject

<?php

    require_once "db_connector.php";

    $usersql = "SELECT user_id, CONCAT(user_fname, ' ', user_lname) as full_name FROM users";
    $resultuser = $connection->query($usersql);

    if($resultuser){
        echo "<select>";
            while($row = $resultuser->fetch_assoc()){
                echo "<option value = '".$row["user_id"]."'>".$row["full_name"]. "</option>";
            }
        echo "</select>";
    }
?>
