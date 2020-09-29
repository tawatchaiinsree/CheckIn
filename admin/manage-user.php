<?php
    require_once("../global.php");
    require_once('component/header.php');
    require("../config/mysql_connect.php");
    require_once("../check_admin.php");
?>

<!------------------------------ BODY -------------------------------->

<label class="center-block-2 font-32 top"><img src="/asset/img/calendar.svg" alt="calendar"
        style="width: 4rem;">ตารางแสดงข้อมูลบุคลากรในระบบ</label>
<div class="left form-inline" style="display: inline; margin:auto;">
    <a href="#" data-target="#reportModal" class="report"></a>
    <button class="btn btn-success btn-lg" style="float: right; margin-right: 1rem;" data-toggle="modal" data-target="#addModal">เพิ่มข้อมูลผู้ใช้</button>
    <input type="text" name="" id="time_to_table" class="margin-top: 1rem;" hidden>
    <table id="example" class="table table-striped table-bordered top tb-center top"
        style="width:90% justify-content: center; align-content: center;">
        <thead>
            <tr style="text-align: center;">
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อ-สกุล</th>
                <th>ประเภท</th>
                <th>ลายเซ็น</th>
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $sql = "SELECT * FROM user
        INNER JOIN user_type ON user.type = user_type.id WHERE user.permission ='user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row['pname'].$row['fname'].' '. $row['lname'];
                $title = $row['title'];
                $username = $row['username'];
                $picture = $row['picture'];
                echo <<< EOD
                <tr>
                    <td>$username</td>
                    <td>$name</td>
                    <td>$title</td>
                    <td><img src="/picture/$picture" alt="ยังไม่เพิ่มลายเซ็น" style="width:20%;"></td>
                    <td>
                    <a href="delete-user.php?id=$username" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?');"><button class="btn btn-danger">ลบ</button></a>
                    <button data-toggle="modal" data-target="#EditModal" class="btn btn-warning" onClick="get_user_data('$username')"> แก้ไข</button>
                    </td>
                </tr>
                EOD;
            }
        }
        ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="EditModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="EditModalTitle">แก้ไขข้อมูลบุคลากร</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/update-user.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label for="username">ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบ (ตัวเลข 4 หลัก):</label>
                        <input type="text" maxlength="4" minlength="4" pattern="\d*" class="form-control col-12" minlength="4"
                            placeholder="กรอกชื่อผู้ใช้งาน" name="usernames" id="usernames" required readonly>
                        <div class="invalid-feedback">กรุณาระบุชื่อผู้ใช้เป็นตัวเลข 4 หลัก</div>
                    </div>
                    <div class="form-group">
                        <label for="pname">คำนำหน้าชื่อ:</label>
                            <input  type="text" class="form-control" name="prefixs" id="pnames" placeholder="คำนำหน้าชื่อ" required>
                    </div>
                    <div class="form-group">
                        <label for="fname">ชื่อจริง:</label>
                        <input type="text" class="form-control col-12"  placeholder="ชื่อจริง" name="fnames" id="fnames" required>
                        <div class="invalid-feedback">กรุณาระบุชื่อจริงของบุคลากร</div>
                    </div>
                    <div class="form-group">
                        <label for="lname">นามสกุล:</label>
                        <input type="text" class="form-control col-12"  placeholder="นามสกุล" name="lnames" id="lnames" required>
                        <div class="invalid-feedback">กรุณาระบุนามสกุลของบุคลากร</div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="position">ตำแหน่ง:</label>
                        <input type="text" class="form-control col-12"  placeholder="ตำแหน่ง"
                            name="positions" id="positions" required>
                        <div class="invalid-feedback">กรุณาระบุตำแหน่งของบุคลากร</div>
                    </div> -->
                    <div class="form-group">
                        <label for="types">ประเภท:</label>
                       <select name="types" id="user_types" class="form-control" >
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
                        <input type="email" class="form-control col-12"  placeholder="ไม่บังคับ" name="email" id="emails">
                        <div class="invalid-feedback">ไม่บังคับ</div>
                    </div>
                    <label for="fileToUpload">รูปลายเซ็นของบุคลากร</label>
                    <input type="file" class="btn btn-warning" name="fileToUpload"  accept="image/png">
                    <button style="text-align:center;" type="submit" class="btn btn-primary">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addModalTitle">เพิ่มข้อมูลผู้ใช้</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="/upload.php" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label for="username">ชื่อผู้ใช้งานสำหรับเข้าสู่ระบบ (ตัวเลข 4 หลัก):</label>
                        <input type="text" maxlength="4" minlength="4" pattern="\d*" class="form-control col-12" minlength="4"
                            placeholder="กรอกชื่อผู้ใช้งาน" name="username" required>
                        <div class="invalid-feedback">กรุณาระบุชื่อผู้ใช้เป็นตัวเลข 4 หลัก</div>
                    </div>
                    <!-- <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <div class="input-group" id="show_hide_password">
                        <input class="form-control" type="password" name="password" placeholder="กรุณาระบุรหัสผ่านของบุคลากร" required>
                        <div class="input-group-addon" style="padding: 0.5rem;">
                            <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="pname">คำนำหน้าชื่อ:</label>
                            <input  type="text" class="form-control" name="prefix" placeholder="คำนำหน้าชื่อ" required>
                    </div>
                    <div class="form-group">
                        <label for="fname">ชื่อจริง:</label>
                        <input type="text" class="form-control col-12"  placeholder="ชื่อจริง" name="fname" required>
                        <div class="invalid-feedback">กรุณาระบุชื่อจริงของบุคลากร</div>
                    </div>
                    <div class="form-group">
                        <label for="lname">นามสกุล:</label>
                        <input type="text" class="form-control col-12"  placeholder="นามสกุล" name="lname" required>
                        <div class="invalid-feedback">กรุณาระบุนามสกุลของบุคลากร</div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="position">ตำแหน่ง:</label>
                        <input type="text" class="form-control col-12"  placeholder="ตำแหน่ง"
                            name="position" required>
                        <div class="invalid-feedback">กรุณาระบุตำแหน่งของบุคลากร</div>
                    </div> -->
                    <div class="form-group">
                        <label for="type">ประเภท:</label>
                       <select name="type" class="form-control" >
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
                        <input type="email" class="form-control col-12"  placeholder="ไม่บังคับ" name="email">
                        <div class="invalid-feedback">ไม่บังคับ</div>
                    </div>
                    
                    <label for="fileToUpload">รูปลายเซ็นของบุคลากร</label>
                    <input type="file" class="btn btn-warning" name="fileToUpload"  accept="image/png">
                    
                    <button style="text-align:center;" type="submit" class="btn btn-primary">ลงทะเบียน</button>
                    <!-- <a href="../login">กลับไปหน้าเข้าสู่ระบบ คลิ๊กที่นี่</a> -->
                </form>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
<script src="/asset/datable.min.js"></script>
<script src="/asset/datatable.boostrap4.min.js"></script>
<!----------------------------- END BODY ----------------------------->

<?php
    require_once('component/footer.php');
?>