<?php
    require_once("../global.php");
    require_once('component/header.php');
    require("../config/mysql_connect.php");
    require_once("../check_admin.php");
?>

<!------------------------------ BODY -------------------------------->

<!-- <div class="report">
    <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">
        <h2><img src="/asset/img/report.png" alt="calendar" style="width: 2rem;">ออกรายงาน</h2>
    </a>
</div> -->

<label  class="center-block-2 font-32"><img src="/asset/img/calendar.svg" alt="calendar" style="width: 4rem;">ตารางข้อมูลการลงเวลาปฏิบัติงานของข้าราชการ</label> 
<div class="left form-inline" style="display: inline; margin:auto; margin-top: 1%;">
<a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="report">
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
        $sql = "SELECT *, DATE_FORMAT(date,'%d/%m/%Y') date, user_type.title user_type, checktime_status.title checktime FROM check_time 
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
                echo <<< EOD
                <tr>
                    <td>$date</td>
                    <td>$name</td>
                    <td>$title</td>
                    <td>$checkin_time</td>
                    <td>$checkout_time</td>
                    <td>$checkin_status</td>
                    <td>$note</td>
                    <td></td>
                </tr>
                EOD;
            }
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalCenterTitle">ตัวเลือกการออกรายงาน</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="report.php" method="post" target="_blank">
                <div class="form-group">
                    <label for="user_type">เลือกประเภทพนักงาน </label>
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
                    <label for="date" class="left">เลือกวันที่เริ่ม: </label>
                    <input type="date" name="start_date" id="start_date" class="left">
                </div>
                <label for="date" class="left">เลือกวันที่สิ้นสุด: </label>
                <input type="date" name="end_date" id="end_date" class="left">
                <br>
                <button type="submit" class="left btn btn-warning font-25">ออกรายงาน</button>
                
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