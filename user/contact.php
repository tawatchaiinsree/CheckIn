<?php
    require_once('../config/mysql_connect.php');
    session_start();
    $user = $_SESSION['username'];
    $subject = $_POST['subject'];
    $detail = $_POST['detail'];

    $sql = "INSERT INTO `contact_admin` (`subject`, `detail`, `username`, `reply_status`) VALUES ('$subject', '$detail', '$user', '0')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('ส่งข้อความไปยังผู้ดูแลระบบเรียบร้อยแล้ว');location.replace('/');</script>";
        }
?>