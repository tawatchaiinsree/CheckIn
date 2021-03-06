<?php
    require_once("../global.php");
    require_once('component/header.php');
    require("../config/mysql_connect.php");
    require_once("../check_users.php")
?>

<!------------------------------ BODY -------------------------------->
    <div class="row center-block">
        <br>
        <img src="/asset/img/calendar.svg" alt="calendar" style="width: 4rem;"> <label id="show_thaidate" style="margin:auto; font-size: 28px;"></label>
    </div>
    <table class="tb-center top">
        <tr>
            <td>เวลามา</td>
            <td>เวลากลับ</td>
            <td>หมายเหตุ</td>
        </tr>
        <tr>

        <?php
        $sql = "SELECT * FROM check_time  WHERE username ='".$_SESSION[username]."' AND `date`='".date("Y-m-d")."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['checkout_time'] === NULL){
                    $ckeckout = 'ยังไม่ออกงาน';
                }else{
                    $checkout = $row['checkout_time'].' น.';
                }
                echo '
                <td><input type="text" name="checkin" value="'.$row['checkin_time'].' น." readonly style="text-align:center;"></td>
                <td><input type="text" name="checkout" class="left" value="'.$ckeckout.'" readonly style="text-align:center;"></td>
                ';
            }
        }else{
            echo '
            <td><input type="text" name="checkin" value="-" readonly style="text-align:center;"></td>
            <td><input type="text" name="checkout" class="left" value="-" readonly style="text-align:center;"></td>
            ';
        }
        ?>
            <td>
            <form action="check_time.php" method="post">
                <input type="text" name="time" id="time_to_table" hidden>
                <input class="left" style="margin-top: -1rem;" type="text" name="note" id="" placeholder="หมายเหตุ (ถ้ามี)">
                <button style="margin-left: 3rem;" class="btn btn-info font-25">บันทึก</button>

            </form>
            </td>
        </tr>
    </table>
    <hr>
    <h1 style="text-align: center; margin-top: 2rem; "><img src="/asset/img/calendar.svg" alt="calendar" style="width: 4rem;"> ตารางประวัติการลงเวลาปฏิบัติงาน</h1>

    <div class="left form-inline" style="display: inline;">
    <table id="example" class="table table-striped table-bordered top display" style="width:90% justify-content: center; align-content: center;">
    <thead>
            <tr style="text-align: center;">
                <th>วันที่</th>
                <th>เวลามา</th>
                <th>เวลากลับ</th>
                <th>สถานะ</th>
                <th>หมายเหตุ(เข้า)</th>
                <th>หมายเหตุ(ออก)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $month = ['','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายนน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน', 'ธันวาคม'];
        $sql = "SELECT *, DATE_FORMAT(date,'%d/%m/%Y') date FROM check_time INNER JOIN checktime_status ON check_time.checkin_status = checktime_status.id  WHERE username ='".$_SESSION[username]."'";
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
            echo <<< EOD
            <tr>
                <td>$date</td>
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