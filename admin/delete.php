<?php
    require_once('../config/mysql_connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM check_time WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('ลบข้อมูลสำเร็จ');location.replace('/');</script>";
        }else{
            echo "<script>alert('เกิดข้อผิดพลาด');location.replace('/');</script>";
        }
?>