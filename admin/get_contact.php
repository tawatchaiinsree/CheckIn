<?php
require("../config/mysql_connect.php");
$result = $conn->query("SELECT * FROM contact_admin INNER JOIN user ON user.username = contact_admin.username WHERE id = '".$_POST['id']."'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '{
                    "id": "'.$row["id"].'",
                    "subject": "'.$row["subject"].'",
                    "detail": "'.$row["detail"].'",
                    "reply_msg": "'.$row["reply_msg"].'"
                }';
            }
        }
if($_POST['user'] === 'admin'){
    $sql = "UPDATE `contact_admin` SET reply_status = '1' WHERE id = '".$_POST['id']."'";
    if ($conn->query($sql) === TRUE) {}
}
if($_POST['user'] === 'user'){
    $sql = "UPDATE `contact_admin` SET read_status = '1' WHERE id = '".$_POST['id']."'";
    if ($conn->query($sql) === TRUE) {}
}

?>