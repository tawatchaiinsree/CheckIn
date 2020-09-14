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
                        <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning font-25" style="float: right; margin-right: 2rem;"> <i class="fa fa-id-card" aria-hidden="true"></i> แก้ไขข้อมูลส่วนตัว</button>
                    </div>
                    EOD;
            ?>
    </div>
    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลส่วนตัว</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="edit_detail.php" method="post">
          <input type="text" name="username" id="username" value="<?php echo $username; ?>" hidden>
      <div class="modal-body font-25">
        <div class="form-inline">
            <label for="pname">คำนำหน้าชื่อ:</label>
            <div class="autocomplete" style="width:300px;">
                <input id="myInput" type="text" class="form-control left" name="pname" value="<?php echo $prefix; ?>" placeholder="คำนำหน้าชื่อ">
            </div>
        </div>
                <div class="form-inline top">
                    <label for="fname">ชื่อ: </label>
                    <input type="text" name="fname" id="fname" class="form-control left" placeholder="ระบุชื่อจริง" value="<?php echo $fname; ?>" required>
                    <label for="lname" class="left">นามสกุล: </label>
                    <input type="text" name="lname" id="lname" class="form-control left" placeholder="ระบุชื่อนามสกุล" value="<?php echo $lname; ?>" required>
                </div>

                <div class="form-inline top">
                    <label for="position">ตำแหน่ง: </label>
                    <input type="text" name="position" id="position" class="form-control left" placeholder="ตำแหน่ง" value="<?php echo $position; ?>" required>
                </div>

                <div class="form-inline top">
                    <label for="email">อีเมล: </label>
                    <input type="email" name="email" id="email" class="form-control left" placeholder="อีเมล" value="<?php echo $email; ?>" required>
                </div>

                <div class="form-inline top">
                    <label for="phone">เบอร์โทร: </label>
                    <input type="text" name="phone" id="phone" class="form-control left" minlength="10" maxlength="10" placeholder="เบอร์โทรศัพท์" value="<?php echo $phone; ?>" required>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
      </div>
    </form>
    </div>
  </div>
</div>

   
    <div style="width: 100%; height: 100%;">