<?php
    require_once('../config/mysql_connect.php');
    session_start();

    $time = $_POST['time'];
    $user = $_SESSION['username'];
    $date = date("Y-m-d");
    $note = $_POST['note'];

    $sql = "SELECT * FROM check_time WHERE username = '$user' AND `date` = '$date'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['checkout_time'] == NULL){
                $sql = "UPDATE `check_time` SET checkout_time ='$time' WHERE username = '$user' AND `date` = '$date'";
                if ($conn->query($sql) === TRUE) {
                    $checkin = $row['checkin_time'];
                    $checkout = $time;

                    if(strtotime($checkin) <= strtotime('08:00') && strtotime($checkout) >= strtotime('16:30')){
                        $sql = "UPDATE `check_time` SET note2='$note', checkin_status ='ปกติ' WHERE username = '$user' AND `date` = '$date'"; //ปกติ
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('บันทึกเวลาออกงานสำเร็จ');location.replace('index.php');</script>";
                        }else{
                            echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                        }
                    }
                    else if(strtotime($checkin) > strtotime('08:00') && strtotime($checkout) > strtotime('16:30')){
                        $sql = "UPDATE `check_time` SET note2='$note', checkin_status ='สาย' WHERE username = '$user' AND `date` = '$date'"; //เข้าสาย
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('บันทึกเวลาออกงานสำเร็จ');location.replace('index.php');</script>";
                        }else{
                            echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                        }
                    }
                    else if(strtotime($checkin) < strtotime('08:00') && strtotime($checkout) < strtotime('16:30')){
                        $sql = "UPDATE `check_time` SET note2='$note', checkin_status ='ออกก่อนเวลาทำการ' WHERE username = '$user' AND `date` = '$date'"; //ออกก่อน
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('บันทึกเวลาออกงานสำเร็จ');location.replace('index.php');</script>";
                        }else{
                            echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                        }
                    }
                    else if(strtotime($checkin) > strtotime('08:00') && strtotime($checkout) < strtotime('16:30')){
                        $sql = "UPDATE `check_time` SET note2='$note', checkin_status ='เข้าสายและออกก่อน' WHERE username = '$user' AND `date` = '$date'"; //เข้าสาย และ ออกก่อน
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('บันทึกเวลาออกงานสำเร็จ');location.replace('index.php');</script>";
                        }else{
                            echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                        }
                    }
                } else {
                    echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                }
            }else{
                echo "<script>alert('ขออภัย วันนี้ท่านได้ลงเวลาเข้าและออกงานครบแล้ว');alert('หากท่านลงเวลาผิด โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
            }
          }
    }else{
        $sql = "INSERT INTO `check_time` (`checkin_time`, `date`, `checkin_status`, `note1`, `username`) VALUES ('$time', '$date', '0', '$note', '$user')";
        if ($conn->query($sql) === TRUE) {
            if(strtotime($time) <= strtotime('08:00')){
                $sql = "UPDATE `check_time` SET note2='$note', checkin_status ='ปกติ' WHERE username = '$user' AND `date` = '$date'"; //ปกติ
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('บันทึกเวลาออกงานสำเร็จ');location.replace('index.php');</script>";
                }else{
                    echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                }
            }
            else if(strtotime($time) > strtotime('08:00')){
                $sql = "UPDATE `check_time` SET note2='$note', checkin_status ='สาย' WHERE username = '$user' AND `date` = '$date'"; //เข้าสาย
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('บันทึกเวลาออกงานสำเร็จ');location.replace('index.php');</script>";
                }else{
                    echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
                }
            }
            echo "<script>alert('บันทึกเวลาเข้างานสำเร็จ');location.replace('index.php');</script>";
        } else {
            // echo $conn->error;
            echo "<script>alert('เกิดข้อผิดพลาด!! โปรดติดต่อผู้ดูแลระบบ');location.replace('index.php');</script>";
        }
    }
?>