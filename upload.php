<?php
require_once('config/mysql_connect.php');
$username = $_POST['username'];
$password = $_POST['password'];
$passwords = $_POST['passwords'];
$prefix = $_POST['prefix'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$position = $_POST['position'];
$type = $_POST['type'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if ($password == $passwords){
$password = md5($password);
$base_name = basename( $_FILES["fileToUpload"]["name"]);
$file_name = explode(".", $base_name)[0];
$file_s = explode(".", $base_name)[1];
$files = $_POST['username'].time().".".$file_s;
$target_file = "picture/" . $files;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($_FILES["fileToUpload"]["size"] > 10000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO `user` (`username`, `password`, `pname`, `fname`, `lname`, `position`, `type`, `email`, `phone`, `permission`, `picture`) 
    VALUES ('$username', '$password', '$prefix', '$fname', '$lname', '$position', '$type', '$email', '$phone', 'user', '$files')";
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('ลงทะเบียนสำเร็จ! ท่านสามารถ Login เพื่อใช้งานระบบได้ทันที');location.replace(\"index.php\");</script>";
    } else {
      echo "<script>alert('มีชื่อผู้ใช้นี้ในระบบแล้ว!!');window.history.back();</script>";
      
    }
$conn->close();
  } else {
    echo "<script>alert('เกิดข้อผิดพลาดเกี่ยวกับการอัพโหลดรูปภาพ โปรดตรวจสอบขนาดของรูปภาพอีกครั้งว่าเกิน 10 MB หรือไม่');window.history.back();</script>";
  }
}else{
  echo "<script>alert('รหัสผ่านของท่านไม่ตรงกัน');window.history.back();</script>";
}
?>