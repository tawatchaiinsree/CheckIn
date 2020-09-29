<?php 
    require_once('../config/mysql_connect.php');
    $id = $_POST['id'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $note1 = $_POST['note1'];
    if(strtotime($checkin) <= strtotime('08:30') && strtotime($checkout) >= strtotime('16:30')){
        $sql = "UPDATE `check_time` SET checkin_time = '$checkin', checkout_time ='$checkout', note1 = '$note1', checkin_status ='1' WHERE id = '$id'"; //ปกติ
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace('/');</script>";
        }else{
            echo $conn->error;
            echo "<script>alert('เกิดข้อผิดพลาด!! ');location.replace('/');</script>";
        }
    }
    else if(strtotime($checkin) > strtotime('08:30') && strtotime($checkout) > strtotime('16:30')){
        $sql = "UPDATE `check_time` SET checkin_time = '$checkin', checkout_time ='$checkout', note1 = '$note1', checkin_status ='1' WHERE id = '$id'"; //เข้าสาย
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace('/');</script>";
        }else{
            echo "<script>alert('เกิดข้อผิดพลาด!! ');location.replace('/');</script>";
        }
    }
    else if(strtotime($checkin) < strtotime('08:30') && strtotime($checkout) < strtotime('16:30')){
        $sql = "UPDATE `check_time` SET checkin_time = '$checkin', checkout_time ='$checkout', note1 = '$note1', checkin_status ='1' WHERE id = '$id'"; //ออกก่อน
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace('/');</script>";
        }else{
            echo "<script>alert('เกิดข้อผิดพลาด!! ');location.replace('/');</script>";
        }
    }
    else if(strtotime($checkin) > strtotime('08:30') && strtotime($checkout) < strtotime('16:30')){
        $sql = "UPDATE `check_time` SET checkin_time = '$checkin', checkout_time ='$checkout', note1 = '$note1', checkin_status ='1' WHERE id = '$id'"; //เข้าสาย และ ออกก่อน
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.replace('/');</script>";
        }else{
            echo "<script>alert('เกิดข้อผิดพลาด!! ');location.replace('/');</script>";
        }
    }

?>