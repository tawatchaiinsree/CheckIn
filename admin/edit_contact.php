<?php 
    require_once('../config/mysql_connect.php');
    $id = $_POST['id'];
    $msg = $_POST['reply_msg'];
    $sql = "UPDATE `contact_admin` SET `reply_msg` = '$msg', reply_status = '1' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('ตอบกลับข้อความสำเร็จ');location.replace('/');</script>";
    }else{
        echo $conn->error;
        echo "<script>alert('เกิดข้อผิดพลาด!! ');location.replace('/');</script>";
    }
?>