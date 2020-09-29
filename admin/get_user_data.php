<?php
require("../config/mysql_connect.php");
$result = $conn->query("SELECT * FROM user INNER JOIN user_type ON user.type = user_type.id WHERE username = '".$_POST['id']."'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '{
                    "id": "'.$row["id"].'",
                    "username": "'.$row["username"].'",
                    "password": "'.$row["password"].'",
                    "pname": "'.$row["pname"].'",
                    "fname": "'.$row["fname"].'",
                    "lname": "'.$row["lname"].'",
                    "user_type": "'.$row["user_type"].'",
                    "email": "'.$row["email"].'",
                    "title": "'.$row["title"].'"
                }';
            }
        }
?>