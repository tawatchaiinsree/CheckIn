<?php
    require_once("../global.php");
    require_once('component/header.php');
    require("../config/mysql_connect.php");
    require_once("../check_admin.php");
?>

<!------------------------------ BODY -------------------------------->

<div class="report">
    <h2>ออกรายงาน</h2>
    <form action="report.php" method="post" class="form-inline" target="_blank">
        <label for="user_type">เลือกประเภทพนักงาน </label>
        <select name="user_type" id="user_type" class="left">
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
        <label for="date" class="left">เลือกวันที่เริ่ม: </label>
        <input type="date" name="date" id="date" class="left">
        <label for="date" class="left">เลือกวันที่สิ้นสุด: </label>
        <input type="date" name="date" id="date" class="left">
        <button type="submit" class="left btn btn-warning font-25">ออกรายงาน</button>
    </form>
    <hr>
</div>


    <div class="left form-inline" style="display: inline; margin:auto; margin-top: 1%;">
    <input type="text" name="" id="time_to_table" class="margin-top: 1rem;" hidden>
    <table id="example" class="table table-striped table-bordered top tb-center top" style="width:90% justify-content: center; align-content: center;">
        <thead>
            <tr style="text-align: center;">
                <th>วันที่</th>
                <th>ชื่อ-สกุล</th>
                <th>เวลาเข้างาน</th>
                <th>เวลาออกงาน</th>
                <th>สถานะ</th>
                <th>หมายเหตุ(เข้า)</th>
                <th>หมายเหตุ(ออก)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $month = ['','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายนน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน', 'ธันวาคม'];
        $sql = "SELECT *, DATE_FORMAT(date,'%d/%m/%Y') date FROM check_time 
        INNER JOIN checktime_status ON check_time.checkin_status = checktime_status.id 
        INNER JOIN user ON check_time.username = user.username";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $date = explode("/", $row['date']);
                $date = $date[0].' '.$month[intval($date[1])].' '.($date[2]+543);
                $checkin_time = $row['checkin_time'];
                $checkout_time = $row['checkout_time'];
                $checkin_status = $row['title'];
                $note1 = $row['note1'];
                $note2 = $row['note2'];
                $name = $row['pname'].$row['fname'].' '. $row['lname'];
                echo <<< EOD
                <tr>
                    <td>$date</td>
                    <td>$name</td>
                    <td>$checkin_time</td>
                    <td>$checkout_time</td>
                    <td>$checkin_status</td>
                    <td>$note1</td>
                    <td>$note2</td>
                </tr>
                EOD;
            }
        }
        ?>
            </tbody>
    </table>
</div>


<script src="script.js"></script>
<script src="/asset/datable.min.js"></script>
<script src="/asset/datatable.boostrap4.min.js"></script>
<!----------------------------- END BODY ----------------------------->

<?php
    require_once('component/footer.php');
?>