<?php
    require_once("../global.php");
    require_once('component/header.php');
    require("../config/mysql_connect.php");
    require_once("../check_admin.php");
    $result = $conn->query("SELECT *, check_time.id ids, checktime_status.id idc FROM user
	LEFT JOIN check_time ON user.username = check_time.username
	LEFT JOIN checktime_status ON checktime_status.id = check_time.checkin_status
    WHERE check_time.date = '".date("Y-m-d")."' AND user.permission = 'user'");
    $come_count = 0;
	$no_come_count = 0;
    $late_count = 0;
    $count = 0;
    foreach ($result as $key => $value) {
        if($key == 0){
            $first_id = $value['ids'];
        }
        if($value['idc'] == '2'){
            $late_count++;
        }
        $count++;
        $come_count++;
    }
    $result = $conn->query("SELECT * FROM user
RIGHT JOIN check_time ON check_time.username != user.username
WHERE user.permission = 'user' AND check_time.id = '$first_id'");
foreach ($result as $key => $value) {
    $count++;
    $no_come_count++;
}
if($come_count == 0){
    $no_come_count = $count;
}
?>

<!------------------------------ BODY -------------------------------->

<!-- <div class="report">
    <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">
        <h2><img src="/asset/img/report.png" alt="calendar" style="width: 2rem;">ออกรายงาน</h2>
    </a>
</div> -->
<div style="justify-content: center; align-content: center;">
    <h1 style="text-align: center" id="show_thaidate">สถานะข้าราชการทั้งหมด</h1>
</div>
<div class="row top">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background-color: rgba(50, 241, 255, 0.849);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการทั้งหมด</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $count-$come_count+1; ?> คน</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background-color: rgba(93, 255, 87, 0.719);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการที่มาทำงาน</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $come_count; ?> คน</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background-color: rgba(255, 110, 110, 0.986);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการที่ไม่มาทำงาน</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $no_come_count-$come_count+1; ?> คน</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background-color: rgba(255, 185, 32, 0.781);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการที่เข้างานสาย</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $late_count; ?> คน</h2>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row top">

    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="
        background: rgb(85,251,255);
        background: linear-gradient(90deg, rgba(85,251,255,1) 0%, rgba(99,251,255,1) 42%, rgba(0,189,255,1) 100%);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการทั้งหมด</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $count-$come_count+1; ?> คน</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background: linear-gradient(90deg, #f8ff00 0%, #3ad59f 100%);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการที่มาทำงาน</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $come_count; ?> คน</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background: rgb(255,150,85);
        background: linear-gradient(90deg, rgba(255,150,85,1) 0%, rgba(226,110,52,1) 42%, rgba(255,64,0,1) 100%);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการที่ไม่มาทำงาน</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $no_come_count-$come_count+1; ?> คน</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card" style="background: rgb(255,216,85);
        background: linear-gradient(90deg, rgba(255,216,85,1) 0%, rgba(255,217,99,1) 42%, rgba(255,141,0,1) 100%);">
            <div class="card-body">
                <h1 class="card-title">ข้าราชการที่เข้างานสาย</h1>
                <h2 class="card-subtitle mb-2 text-muted">จำนวน <?php echo $late_count; ?> คน</h2>
            </div>
        </div>
    </div>
</div> -->

<hr>
<label class="center-block-2 font-32 top"><img src="/asset/img/calendar.svg" alt="calendar"
        style="width: 4rem;">ตารางข้อมูลการลงเวลาปฏิบัติงานของข้าราชการ</label>
<div class="left form-inline" style="display: inline; margin:auto;">
    <button class="btn btn-success">เพิ่มข้อมูล</button>
    <a href="#" data-toggle="modal" style="margin-right: 1rem;" data-target="#reportModal" class="report">
        <label><img src="/asset/img/report.png" alt="calendar" style="width: 3rem;">ออกรายงาน</label>
    </a>
    <input type="text" name="" id="time_to_table" class="margin-top: 1rem;" hidden>
    <table id="example" class="table table-striped table-bordered top tb-center top"
        style="width:90% justify-content: center; align-content: center;">
        <thead>
            <tr style="text-align: center;">
                <th>วันที่</th>
                <th>ชื่อ-สกุล</th>
                <th>ประเภท</th>
                <th>เวลาเข้างาน</th>
                <th>เวลาออกงาน</th>
                <th>สถานะ</th>
                <th>หมายเหตุ</th>
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $month = ['','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายนน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน', 'ธันวาคม'];
        $sql = "SELECT *, DATE_FORMAT(date,'%d/%m/%Y') date, user_type.title user_type, checktime_status.title checktime, check_time.id CID FROM check_time 
        INNER JOIN checktime_status ON check_time.checkin_status = checktime_status.id 
        INNER JOIN user ON check_time.username = user.username
        INNER JOIN user_type ON user.type = user_type.id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $date = explode("/", $row['date']);
                $date = $date[0].' '.$month[intval($date[1])].' '.($date[2]+543);
                $checkin_time = $row['checkin_time'];
                $checkout_time = $row['checkout_time'];
                $checkin_status = $row['checktime'];
                $note1 = $row['note1'];
                $note2 = $row['note2'];
                $note = $note1.$note2;
                $name = $row['pname'].$row['fname'].' '. $row['lname'];
                $title = $row['user_type'];
                $id = $row['CID'];
                echo <<< EOD
                <tr>
                    <td>$date</td>
                    <td>$name</td>
                    <td>$title</td>
                    <td>$checkin_time</td>
                    <td>$checkout_time</td>
                    <td>$checkin_status</td>
                    <td>$note</td>
                    <td><button data-toggle="modal" data-target="#EditModal" class="btn btn-warning" onClick="get_data('$id')"> แก้ไข</button>
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
<div class="modal fade bd-example-modal-lg" id="reportModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">ตัวเลือกการออกรายงาน</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="report.php" method="post" target="_blank">
                    <div class="form-group">
                        <label for="user_type">เลือกประเภทข้าราชการ </label>
                        <select name="user_type" id="user_type" class="left form-group">
                            <option value="0">ทั้งหมด</option>
                            <?php 
                $sql = "SELECT * FROM `user_type`";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $title = $row['title'];
                    echo <<< EOD
                    <option value="$id">$title</option>
                EOD;
                }
            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date" class="left">วันที่: </label>
                        <input type="date" name="start_date" id="start_date" class="left">
                    </div>
                    <!-- <label for="date" class="left">เลือกวันที่สิ้นสุด: </label>
                <input type="date" name="end_date" id="end_date" class="left"> -->
                    <br>
                    <button type="submit" class="left btn btn-warning font-25">ออกรายงาน</button>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="EditModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="EditModalTitle">แก้ไขข้อมูลการลงเวลา</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="edit_data.php" method="post">
                    <table>
                        <input class="form-control" type="text" name="id" id="edit_id" hidden>
                        <tr>
                            <td>เวลาเข้างาน</td>
                            <td><input class="form-control" type="time" name="checkin" id="checkin"></td>
                        </tr>
                        <tr>
                            <td>เวลาออกงาน</td>
                            <td><input class="form-control" type="time" name="checkout" id="checkout"></td>
                        </tr>
                        <tr>
                            <td>หมายเหตุ(เข้า)</td>
                            <td><input class="form-control" type="text" name="note1" id="note1"></td>
                        </tr>
                        <tr>
                            <td>หมายเหตุ(ออก)</td>
                            <td><input class="form-control" type="text" name="note2" id="note2"></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-success">บันทึก</button>
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