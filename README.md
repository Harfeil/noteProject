# noteProject

<table class = "supplierTable" >

                        <thead >
                            <tr class = "supplierTableHeader">
                                <th id = "suppCol">ID</th>
                                <th id = "suppCol">COMPANY NAME</th>
                                <th id = "suppCol">FIRST NAME</th>
                                <th id = "suppCol">LAST NAME</th>
                                <th id = "suppCol">CONTACT NUMBER</th>
                                <th id = "suppCol">EMAIL</th>
                                <th id = "suppCol">ADDRESS</th>
                                <th id = "suppCol">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody  >
                
                            <?php
                               require_once('db_connector.php');


                                $sql = "SELECT * From supplier";
                                $result = $connection->query($sql);

                                if(!$result){
                                    die("Invalid query: ". $connection->error);
                                }

                                while($row = $result->fetch_assoc()){
                                    echo "
                                    <tbody class = 'table-row'>
                                        <td    id = 'supplierRow'>$row[sup_id]</td>
                                         <td id = 'supplierRow' style = 'padding-left = 400px;'>$row[company_name]</td>
                                        <td  id = 'supplierRow' style = 'padding-left = 400px;'>$row[sup_fname]</td>
                                        <td   id = 'supplierRow'>$row[sup_lname]</td>
                                        <td  id = 'supplierRow'>$row[contact_num]</td>
                                        <td id = 'supplierRow'>$row[email]</td>
                                        <td  id = 'supplierRow'>$row[address]</td>
                                        <td  id = 'supplierRow'>
                                            <button data-supId = '$row[sup_id]' data-company = '$row[company_name]' data-supFname = '$row[sup_fname]' data-supLname = '$row[sup_lname]' data-supNumber = '$row[contact_num]' data-supEmail = '$row[email]' data-supAddress = '$row[address]' class = 'suppEditBtn'  id = 'suppEditBtn'>Edit</button>
                                            <button data-supId = '$row[sup_id]' class = 'deleteBtnSup' id = 'deleteBtnSup'>Delete</button>
                                        </td> 
                                    ";
                                    echo '</tr>';
                                }
                            ?>
                
                        </tbody>

                     </table>

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
