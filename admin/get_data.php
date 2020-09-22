<?php
require("../config/mysql_connect.php");
$result = $conn->query("SELECT * FROM check_time WHERE id = '".$_POST['id']."'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '{
                    "id": "'.$row["id"].'",
                    "checkin_time": "'.$row["checkin_time"].'",
                    "checkout_time": "'.$row["checkout_time"].'",
                    "note1": "'.$row["note1"].'",
                    "note2": "'.$row["note2"].'"
                }';
            }
        }
?>