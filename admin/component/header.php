<?php 
        require_once('../config/mysql_connect.php');
        session_start();
        $username = $_SESSION['username'];
        $prefix = $_SESSION['pname'];
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $position = $_SESSION['position'];
        $type = $_SESSION['type'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $sql = "SELECT COUNT(username) count FROM contact_admin WHERE username = 'test' AND reply_status = '1'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $count = $row['count'];
        }
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>สำนักงานที่ดินจังหวัดสงขลา</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/asset/img/icon.png" type="image/icon type">
  <link rel="stylesheet" href="/asset/bootstrap4/css/bootstrap.min.css">
  <link rel="stylesheet" href="/admin/component/style.css">
  <script src="/asset/bootstrap4/js/jquery.min.js"></script>
  <script src="/asset/bootstrap4/js/popper.min.js"></script>
  <script src="/asset/bootstrap4/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/asset/fonts/iconic/css/material-design-iconic-font.min.css">
  <script type="text/javascript" src="/asset/moment-with-locales.min.js"></script>

</head>

<body>
  <ul class="ul">
    <li><img src="../../asset/img/icon.png" alt="icon" style="width: 5rem;">
    <label style="font-size: 32px;color: ivory; margin-top: 0.75rem;">สำนักงานที่ดินจังหวัดสงขลา</label></li>
        <li style="float:right"><a href="/logout.php" style="color: ivory;"><button class="btn btn-danger font-25"><i class="fa fa-power-off" aria-hidden="true"></i>ออกจากระบบ</button></a></li>
        <li style="float:right"><a href="#" data-toggle="modal" data-target="#ContactModal" style=" font-size: 28px; color: ivory;"><i class="fa fa-phone" aria-hidden="true"></i>ติดต่อเรา <span class="badge badge-danger"><?php echo $count; ?></span></a></li>
        <li style="float:right" class="active"><a href="/" style="font-size: 28px;"><i class="fa fa-home" aria-hidden="true"></i>หน้าหลัก</a></li>
  </ul>
<div class="ul-2">
      <label style="margin-left: 2%;" class="font-25"><?php echo $_SESSION['pname'].$_SESSION['fname'].' '.$_SESSION['lname']; ?></label>
  </div>

  <div id="page-content-wrapper">
      <div style="width: 98%; height: 100%;">