<?php
    require_once('../config/mysql_connect.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE username = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('ลบข้อมูลสำเร็จ');location.replace('/admin/manage-user.php');</script>";
        }else{
            echo "<script>alert('เกิดข้อผิดพลาด');location.replace('/admin/manage-user.php');</script>";
        }
?>