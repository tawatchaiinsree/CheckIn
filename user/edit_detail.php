<?php 
    require_once('../config/mysql_connect.php');
    session_start();
    $username = $_POST['username'];
    $prefix = $_POST['pname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    // $phone = $_POST['phone'];

    $sql = "UPDATE `user` SET 
    pname='$prefix', 
    fname='$fname', 
    lname='$lname', 
    position='$position', 
    email='$email', 
    phone='-' 
    WHERE username = '$username'";
    
if ($conn->query($sql) === TRUE) {
    $sql = "SELECT * FROM `user` 
    INNER JOIN `user_type` ON user.type = user_type.id 
    WHERE username = '$username'";
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $_SESSION['pname'] = $row['pname'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['position'] = $row['position'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['picture'] = $row['picture'];
        }
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace('index.php');</script>";
            }else{
            echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
            }
?>