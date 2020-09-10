<?php 
        session_start();
        $username = $_SESSION['username'];
        $prefix = $_SESSION['pname'];
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $position = $_SESSION['position'];
        $type = $_SESSION['type'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>สำนักงานที่ดินจังหวัดสงขลา</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/asset/img/icon.png" type="image/icon type">
    <link rel="stylesheet" href="/asset/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/user/component/style.css">
    <script src="/asset/bootstrap4/js/jquery.min.js"></script>
    <script src="/asset/bootstrap4/js/popper.min.js"></script>
    <script src="/asset/bootstrap4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/asset/fonts/iconic/css/material-design-iconic-font.min.css">
    <script type="text/javascript" src="/asset/moment-with-locales.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body >

    <!-- Menu -->
    <div id="page-content-wrapper">
        
      <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color: #595959;">
        <img src="../../asset/img/icon.png" alt="icon" style="width: 5rem;">
        <label style="font-size: 32px;color: ivory;">สำนักงานที่ดินจังหวัดสงขลา</label>

        <a href="/" style="margin-left: 50%; font-size: 28px;"><i class="fa fa-home" aria-hidden="true"></i>หน้าหลัก</a>
        <a href="contact.php" style="margin-left: 2rem; font-size: 28px; color: ivory;"><i class="fa fa-phone" aria-hidden="true"></i>ติดต่อเรา</a>
        <a href="/logout.php" style="margin-left: 2rem;color: ivory;"><button class="btn btn-danger font-25"><i class="fa fa-power-off" aria-hidden="true"></i>ออกจากระบบ</button></a>
      </nav>

      <div class="d-flex flex-row bd-highlight mb-3" style="height: 860px;">
    <div class="p-2 bd-highlight bg-light border-right" style="width: 25rem;">
        <img src="/picture/<?php echo $_SESSION['picture'] ?>" class="profile-pic">
        <?php 
            // print_r($_SESSION);
                echo <<< EOD
                    <div class="center-block-profile">
                        <br>
                        <h4>ข้อมูลส่วนตัว</h4>
                        <p>ชื่อ: $prefix$fname $lname</p>
                        <p>ตำแหน่ง: $position</p>
                        <p>อีเมล: $email</p>
                        <p>เบอร์โทรติดต่อ: $phone</p>
                        <br>
                        <button class="btn btn-warning font-25" style="float: right; margin-right: 2rem;"> <i class="fa fa-id-card" aria-hidden="true"></i> แก้ไขข้อมูลส่วนตัว</button>
                    </div>
                    EOD;
            ?>
    </div>
    <div style="width: 100%; height: 100%;">