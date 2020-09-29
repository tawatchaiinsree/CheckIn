<?php 
        require_once('../config/mysql_connect.php');
        session_start();
        $username = $_SESSION['username'];
        $prefix = $_SESSION['pname'];
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $type = $_SESSION['type'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $sql = "SELECT COUNT(username) count FROM contact_admin WHERE reply_status = '0'";
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
    <li style="float:right"><a href="/logout.php" style="color: ivory;"><button class="btn btn-danger font-25"><i
            class="fa fa-power-off" aria-hidden="true"></i>ออกจากระบบ</button></a></li>
    <!-- <li style="float:right"><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" style=" font-size: 28px; color: ivory;"><i class="fa fa-inbox right" aria-hidden="true"></i>ข้อความ <span class="badge badge-danger"><?php echo $count; ?></span></a></li> -->
    <li style="float:right"><a href="#" data-toggle="modal" data-target="#exampleModalCenter" style=" font-size: 28px; color: ivory;"><i class="fa fa-id-card right" aria-hidden="true"></i>แก้ไขข้อมูลส่วนตัว </a></li>
    <?php if($_SERVER['REQUEST_URI'] == '/admin/manage-user.php'){
    echo '<li style="float:right" class="active"><a href="manage-user.php" style=" font-size: 28px; color: ivory;"><i class="fa fa-group right" aria-hidden="true"></i>จัดการข้อมูลบุคลากร </a></li>';
    }else{echo '<li style="float:right"><a href="manage-user.php" style=" font-size: 28px; color: ivory;"><i class="fa fa-group right" aria-hidden="true"></i>จัดการข้อมูลบุคลากร </a></li>';}
    if($_SERVER['REQUEST_URI'] == '/admin/' || $_SERVER['REQUEST_URI'] == '/admin/index.php'){
      echo '<li style="float:right" class="active"><a href="/" style="font-size: 28px;"><i class="fa fa-home" aria-hidden="true"></i>หน้าหลัก</a></li>';
    }else{echo '<li style="float:right"><a href="/" style="font-size: 28px;"><i class="fa fa-home" aria-hidden="true"></i>หน้าหลัก</a></li>';}
    ?>
  </ul>
  <div class="ul-2">
    <label style="margin-left: 2%;"
      class="font-25"><?php echo $_SESSION['pname'].$_SESSION['fname'].' '.$_SESSION['lname']; ?></label>
  </div>

  <div id="page-content-wrapper">
    <div style="width: 100%; height: 100%;">

      <!-- Modal -->
      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="EditModalTitle">กล่องข้อความ</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body" style="overflow: scroll;">
              <ul class="list-group">
                <?php
                $sql = "SELECT * FROM contact_admin INNER JOIN user ON user.username = contact_admin.username ORDER BY reply_status";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $id = $row['id'];
                      $subject = $row['subject'];
                      $detail = $row['detail'];
                      $reply_status = $row['reply_status'];
                      $reply_msg = $row['reply_msg'];
                      $name = $row['pname'].$row['fname'].' '.$row['lname'];

                      echo <<< EOD
                      <li onClick="get_contact($id)" data-toggle="modal" data-target="#replyModal" class="list-group-item"><strong>$subject</strong> จาก <label>$name</label>
                      EOD;
                      if($reply_status == '0'){
                        echo "<span class=\"badge badge-danger\">ใหม่</span></li>";
                      }
                      if($reply_status == '1' && $reply_msg == NULL){
                        echo "<span class=\"badge badge-warning\">อ่านแล้ว</span></li>";
                      }if($reply_status == '1' && $reply_msg != NULL){
                        echo "<span class=\"badge badge-success\">ตอบแล้ว</span></li>";
                      }
                    }
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="EditModalTitle">กล่องข้อความ</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                  <form action="edit_contact.php" method="post">
                     <input type="text" class="form-control" name="id" id="id" hidden>
                      <h2>หัวเรื่องที่ติดต่อ:</h2> <p id="subject"></p>
                      <hr>
                      <h2>ข้อมูลที่ติดต่อ:</h2> <p id="detail"></p>
                      <hr>
                    <h2>ตอบกลับ:</h2>
                   <textarea class="form-control" name="reply_msg" id="reply_msg" cols="20" rows="5"></textarea>
                   <br>
                   <button type="submit" class="btn btn-success btn-lg">ตอบกลับ</button>
                  </form>
            </div>
          </div>
        </div>
      </div>

       <!-- Modal -->
       <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขข้อมูลส่วนตัว</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <form action="/user/edit_detail.php" method="post">
              <input type="text" name="username" id="username" value="<?php echo $username; ?>" hidden>
              <div class="modal-body font-25">
                <div class="form-inline">
                  <label for="pname">คำนำหน้าชื่อ:</label>
                  <div class="autocomplete" style="width:300px;">
                    <input id="myInput" type="text" class="form-control left" name="pname"
                      value="<?php echo $prefix; ?>" placeholder="คำนำหน้าชื่อ">
                  </div>
                </div>
                <div class="form-inline top">
                  <label for="fname">ชื่อ: </label>
                  <input type="text" name="fname" id="fname" class="form-control left" placeholder="ระบุชื่อจริง"
                    value="<?php echo $fname; ?>" required>
                  <label for="lname" class="left">นามสกุล: </label>
                  <input type="text" name="lname" id="lname" class="form-control left" placeholder="ระบุชื่อนามสกุล"
                    value="<?php echo $lname; ?>" required>
                </div>

                <!-- <div class="form-inline top">
                  <label for="position">ตำแหน่ง: </label>
                  <input type="text" name="position" id="position" class="form-control left" placeholder="ตำแหน่ง"
                    value="<?php //echo $position; ?>" required>
                </div> -->

                <div class="form-inline top">
                  <label for="email">อีเมล: </label>
                  <input type="email" name="email" id="email" class="form-control left" placeholder="อีเมล"
                    value="<?php echo $email; ?>">
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