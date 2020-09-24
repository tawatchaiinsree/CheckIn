<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบ: สำนักงานที่ดินจังหวัดสงขลา</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/asset/img/icon.png" type="image/icon type">
  <link rel="stylesheet" href="/asset/bootstrap4/css/bootstrap.min.css">
  <link rel="stylesheet" href="./style.css">
  <script src="/asset/bootstrap4/js/jquery.min.js"></script>
  <script src="/asset/bootstrap4/js/popper.min.js"></script>
  <script src="/asset/bootstrap4/js/bootstrap.min.js"></script>
  
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <img src="/asset/img/icon.png" class="rounded mx-auto d-block" style="width: 40%;">
        <h2 style="text-align:center; "> สำนักงานที่ดินจังหวัดสงขลา</h2>
      </div>
      <div class="card-body center-block">
        <h3 style="text-align:center; ">เข้าสู่ระบบ</h3>
        <form action="check_login.php" method="post" class="needs-validation" novalidate>
          <div class="form-group">
            <label for="username">ชื่อผู้ใช้งาน(เลขบัตรประจำตัวประชาชน):</label>
            <input type="text" class="form-control col-12" id="username" minlength="13" maxlength="13" placeholder="กรอกชื่อผู้ใช้งาน"
              name="username" pattern="\d*" required>
            <div class="invalid-feedback">กรุณาระบุชื่อผู้ใช้เป็นเลขบัตรประจำตัวประชาชน 13 หลัก (ตัวเลขเท่านั้น)</div>
          </div>
          <div class="form-group">
            <label>รหัสผ่าน</label>
            <div class="input-group" id="show_hide_password">
              <input class="form-control" type="password" name="password" placeholder="กรุณาระบุรหัสผ่านของท่าน"
                required>
              <div class="input-group-addon" style="padding: 0.5rem;">
                <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>

          <button style="text-align:center;" type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
          <a href="../register"><button style="text-align:center;" type="button"
              class="btn btn-warning">ลงทะเบียน</button></a>
          <a href="#" data-toggle="modal" data-target="#forgotModal">ลืมรหัสผ่าน?</a>
        </form>
      </div>
    </div>
  </div>
  </div>

  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="forgotModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="EditModalTitle">ลืมรหัสผ่าน</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        </div>
        <div class="modal-body">
          <form action="#" method="post">
            <div class="form-group">
              <label for="username">ชื่อผู้ใช้งาน(เลขบัตรประจำตัวประชาชน):</label>
              <input type="text" class="form-control col-12" id="fusername" minlength="4" placeholder="กรอกชื่อผู้ใช้งาน"
                name="username" pattern="\d*" minlength="13" maxlength="13" required>
            </div>
            <div class="form-group">
              <label for="email">อีเมลที่ใช้ลงทะเบียน:</label>
              <input type="text" class="form-control col-12" id="femail" minlength="4"
                placeholder="อีเมลที่ท่านใช้ลงทะเบียน" name="email" required>
            </div>
            <br>
            <button type="button" onClick="get_data()" class="btn btn-success btn-lg">ส่งข้อมูล</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://use.fontawesome.com/b9bdbd120a.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script> -->
<script>
  (function () {
    'use strict';
    window.addEventListener('load', function () {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  $(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
      event.preventDefault();
      if ($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass("fa-eye-slash");
        $('#show_hide_password i').removeClass("fa-eye");
      } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass("fa-eye-slash");
        $('#show_hide_password i').addClass("fa-eye");
      }
    });
  });

  function get_data(){
    var username = document.getElementById('fusername').value;
    var email = document.getElementById('femail').value;
    console.log(username, email);
  $.post("get_data.php",
  {
    username: username,
    email: email
  },
  function(data,status){
    if(status === 'success'){
      var data = JSON.parse(data);
      if(data.status == 200){
        alert('รหัสผ่านของคุณคือ ' + data.password);
      }else{
        alert(data.password);
      }
    }
  });
}
</script>