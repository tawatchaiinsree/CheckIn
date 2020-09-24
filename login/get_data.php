<?php
require("../config/mysql_connect.php");
$result = $conn->query("SELECT password FROM user WHERE username = '".$_POST['username']."' AND email='".$_POST['email']."'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '{
                    "password": "'.$row["password"].'",
                    "status": 200
                }';
            }
        }else{
            echo '{
                "password": "ข้อมูลของท่านไม่ตรงกับข้อมูลในระบบ",
                "status": 202
            }';
        }
?>