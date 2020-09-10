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
                <img src="/asset/img/icon.png" class="rounded mx-auto d-block" style="width: 20rem;">
            <h2 style="text-align:center; "> สำนักงานที่ดินจังหวัดสงขลา</h2>
            </div>
            <div class="card-body center-block">
                <h3 style="text-align:center; ">เข้าสู่ระบบ</h3>
                <form action="check_login.php" method="post" class="needs-validation" novalidate>
                  <div class="form-group">
                    <label for="username">ชื่อผู้ใช้งาน:</label>
                    <input type="text" class="form-control col-12" id="username" minlength="4" placeholder="กรอกชื่อผู้ใช้งาน" name="username" required>
                    <div class="invalid-feedback">กรุณาระบุชื่อผู้ใช้ของท่าน (อย่างน้อย 4 ตัวอักษร)</div>
                  </div>
                  <div class="form-group">
                    <label for="pwd">รหัสผ่าน:</label>
                    <input type="password" class="form-control col-12" id="pwd" minlength="8" placeholder="กรอกรหัสผ่าน" name="password" required>
                    <div class="invalid-feedback">กรุณาระบุรหัสผ่านของท่าน (อย่างน้อย 8 ตัวอักษร)</div>
                  </div>

                  <button style="text-align:center;" type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                  <a href="../register">ลงทะเบียนใหม่ คลิ๊กที่นี่</a>
                </form>
              </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>