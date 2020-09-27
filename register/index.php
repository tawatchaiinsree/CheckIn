<?php require_once('../config/mysql_connect.php'); ?>
<?php
    $sql = "SELECT title FROM prefix";
    $result = $conn->query($sql);
    $opt = "";
    if ($result->num_rows > 0) {
        $i=0;
    while($row = $result->fetch_assoc()) {
        if($i - $result->num_rows == -1){
            $opt .= $row["title"];
        }else{
            $opt .= $row["title"].",";
        }
        $i++;
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ลงทะเบียน: สำนักงานที่ดินจังหวัดสงขลา</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/asset/img/icon.png" type="image/icon type">
    <link rel="stylesheet" href="/asset/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <script src="/asset/bootstrap4/js/jquery.min.js"></script>
    <script src="/asset/bootstrap4/js/popper.min.js"></script>
    <script src="/asset/bootstrap4/js/bootstrap.min.js"></script>
</head>

<body>
        <div class="card">
            <div class="card-header">
                <img src="/asset/img/icon.png" class="rounded mx-auto d-block" style="width: 30%;">
                <h2 style="text-align:center; "> สำนักงานที่ดินจังหวัดสงขลา</h2>
            </div>
            <div class="card-body center-block">
                <h3 style="text-align:center; ">ลงทะเบียนใช้งานระบบ</h3>
                <form action="/upload.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label for="username">ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบ (เลขบัตรประจำตัวประชาชน):</label>
                        <input type="text" maxlength="13" minlength="13" pattern="\d*" class="form-control col-12" id="username" minlength="4"
                            placeholder="กรอกชื่อผู้ใช้งาน" name="username" required>
                        <div class="invalid-feedback">กรุณาระบุชื่อผู้ใช้เป็นเลขบัตรประจำตัวประชาชน 13 หลัก (ตัวเลขเท่านั้น)</div>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <div class="input-group" id="show_hide_password">
                        <input class="form-control" type="password" name="password" placeholder="กรุณาระบุรหัสผ่านของท่าน" required>
                        <div class="input-group-addon" style="padding: 0.5rem;">
                            <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pname">คำนำหน้าชื่อ:</label>
                        <div class="autocomplete" style="width:300px;">
                            <input id="myInput" type="text" class="form-control" name="prefix" placeholder="คำนำหน้าชื่อ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname">ชื่อจริง:</label>
                        <input type="text" class="form-control col-12" id="fname" placeholder="ชื่อจริง" name="fname" required>
                        <div class="invalid-feedback">กรุณาระบุชื่อจริงของท่าน</div>
                    </div>
                    <div class="form-group">
                        <label for="lname">นามสกุล:</label>
                        <input type="text" class="form-control col-12" id="lname" placeholder="นามสกุล" name="lname" required>
                        <div class="invalid-feedback">กรุณาระบุนามสกุลของท่าน</div>
                    </div>
                    <div class="form-group">
                        <label for="position">ตำแหน่ง:</label>
                        <input type="text" class="form-control col-12" id="position" placeholder="ตำแหน่ง"
                            name="position" required>
                        <div class="invalid-feedback">กรุณาระบุตำแหน่งของท่าน</div>
                    </div>
                    <div class="form-group">
                        <label for="type">ประเภท:</label>
                       <select name="type" class="form-control" id="type">
                       <?php
                            $sql = "SELECT * FROM user_type";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $title = $row["title"];
                                    $id = $row["id"];
                                    echo <<< EOD
                                        <option value="$id">$title</option>
                                    EOD;
                                }
                            }
                        ?>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="email">อีเมล:</label>
                        <input type="email" class="form-control col-12" id="email" placeholder="อีเมล" name="email" required>
                        <div class="invalid-feedback">กรุณาระบุอีเมลของท่าน</div>
                    </div>
                    <div class="form-group">
                        <label for="phone">หมายเลขโทรศัพท์มือถือ 10 หลัก:</label>
                        <input type="text" class="form-control col-12" id="phone" maxlength="10" minlength="10" pattern="\d*" placeholder="หมายเลขโทรศัพท์มือถือ" name="phone" required>
                        <div class="invalid-feedback">กรุณาระบุหมายเลขโทรศัพท์มือถือของท่าน</div>
                    </div>
                    
                    <label for="fileToUpload">กรุณาอัพโหลดรูปภาพของท่าน</label>
                    <input type="file" class="btn btn-warning" name="fileToUpload" id="fileToUpload" accept="image/*">
                    
                    <br>
                    <br>
                    <button style="text-align:center;" type="submit" class="btn btn-primary">ลงทะเบียน</button>
                    <!-- <a href="../login">กลับไปหน้าเข้าสู่ระบบ คลิ๊กที่นี่</a> -->
                </form>
            </div>
        </div>
    </div>
<script>
  var prefix = "<?php echo $opt; ?>";
  prefix = prefix.split(','); 
</script>
<script src="./script.js"></script>
<script src="https://use.fontawesome.com/b9bdbd120a.js"></script>
</body>
</html>
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
</script>

