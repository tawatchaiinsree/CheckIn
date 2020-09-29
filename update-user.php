<?php
require_once('config/mysql_connect.php');
$username = $_POST['usernames'];
$prefix = $_POST['prefixs'];
$fname = $_POST['fnames'];
$lname = $_POST['lnames'];
$position = $_POST['positions'];
$type = $_POST['types'];
$email = $_POST['email'];

    // print_r($_POST);
    $sql = "UPDATE user SET 
    pname = '$prefix', 
    fname = '$fname', 
    lname = '$lname', 
    position = '$position', 
    type = '$type', 
    email = '$email' WHERE username = '$username'
    ";
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace(\"/admin/manage-user.php\");</script>";
    } else {
      echo "<script>alert('เกิดข้อผิดพลาด!!');window.history.back();</script>";
    }
$conn->close();
?>