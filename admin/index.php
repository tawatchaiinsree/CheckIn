<?php
    require_once("../global.php");
    require_once('component/header.php');
    require("../config/mysql_connect.php");
    require_once("../check_admin.php");
?>

<!------------------------------ BODY -------------------------------->

<form action="" method="post">
    <label for="user_type">ประเภท </label>
    <select name="user_type" id="user_type">
        <?php 
            $sql = "SELECT * FROM check_time INNER JOIN checktime_status ON check_time.checkin_status = checktime_status.id  WHERE username ='".$_SESSION[username]."'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {

            }
            echo <<< EOD
                <option value="">1</option>
            EOD;
        ?>
        
    </select>
</form>

    <div class="left form-inline" style="display: inline; margin:auto">
    <input type="text" name="" id="time_to_table" hidden>
    <table id="example" class="table table-striped table-bordered top tb-center top" style="width:90% justify-content: center; align-content: center;">
        <thead>
            <tr style="text-align: center;">
                <th>วันที่</th>
                <th>เวลาเข้างาน</th>
                <th>เวลาออกงาน</th>
                <th>สถานะ</th>
                <th>หมายเหตุ(เข้า)</th>
                <th>หมายเหตุ(ออก)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM check_time INNER JOIN checktime_status ON check_time.checkin_status = checktime_status.id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $date = $row['date'];
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