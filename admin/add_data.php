<?php
    require_once('../config/mysql_connect.php');
    session_start();

    $checkin = $_POST['checkin_time'];
    $checkout = $_POST['checkout_time'];
    $user = $_POST['username'];
    $date = $_POST['date'];
    $note1 = $_POST['note1'];
    $note2 = $_POST['note2'];
    $status = '';
    // print_r($_POST);
    $sql = "SELECT * FROM check_time WHERE username = '$user' AND `date` = '$date'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
            echo '<script>alert("มีข้อมูลข้าราชการในวันที่เลือกแล้ว");location.replace(\'/\');</script>';
    }else{
        if(strtotime($checkin) <= strtotime('08:00') && strtotime($checkout) >= strtotime('16:30')){
           $status = '1';
        }
        else if(strtotime($checkin) > strtotime('08:00') && strtotime($checkout) > strtotime('16:30')){
            $status = '2';
        }
        else if(strtotime($checkin) < strtotime('08:00') && strtotime($checkout) < strtotime('16:30')){
            $status = '3';
        }
        else if(strtotime($checkin) > strtotime('08:00') && strtotime($checkout) < strtotime('16:30')){
            $status = '4';
        }

        $sql = "INSERT INTO `check_time` (`checkin_time`, `checkout_time`, `date`, `checkin_status`, `note1`, `note2`, `username`) 
        VALUES ('$checkin', '$checkout', '$date', '$status', '$note1', '$note2', '$user')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ');location.replace('/');</script>";
        }
    }
?>