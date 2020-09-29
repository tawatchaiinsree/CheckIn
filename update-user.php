<?php
require_once('config/mysql_connect.php');
$username = $_POST['usernames'];
$prefix = $_POST['prefixs'];
$fname = $_POST['fnames'];
$lname = $_POST['lnames'];
$type = $_POST['types'];
$email = $_POST['email'];


if($_FILES["fileToUpload"]["name"]){
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
    $sql = "UPDATE user SET 
    pname = '$prefix', 
    fname = '$fname', 
    lname = '$lname', 
    type = '$type',
    picture = '$files', 
    email = '$email' WHERE username = '$username'
    ";
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace(\"/admin/manage-user.php\");</script>";
    } else {
      echo "<script>alert('เกิดข้อผิดพลาด!!');window.history.back();</script>";
    }
} else {
    echo "<script>alert('เกิดข้อผิดพลาดเกี่ยวกับการอัพโหลดรูปภาพ โปรดตรวจสอบขนาดของรูปภาพอีกครั้งว่าเกิน 10 MB หรือไม่');window.history.back();</script>";
  }
}else{
    // print_r($_POST);
    $sql = "UPDATE user SET 
    pname = '$prefix', 
    fname = '$fname', 
    lname = '$lname', 
    type = '$type', 
    email = '$email' WHERE username = '$username'
    ";
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace(\"/admin/manage-user.php\");</script>";
    } else {
      echo "<script>alert('เกิดข้อผิดพลาด!!');window.history.back();</script>";
    }
$conn->close();
}

?>