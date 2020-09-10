<?php
    require_once("../global.php");
    require_once('component/header.php');
?>

<!------------------------------ BODY -------------------------------->
    <div class="row center-block">
        <br>
        <img src="/asset/img/calendar.svg" alt="calendar" style="width: 4rem;"> <label id="show_thaidate" style="margin:auto; font-size: 28px;"></label>
    </div>
    <table class="tb-center top">
        <tr>
            <td>เวลาเข้างาน</td>
            <td>เวลาออกงาน</td>
            <td>หมายเหตุ</td>
        </tr>
        <tr>
            <td><input type="text" name="checkin" value="08:30 น." readonly style="text-align:center;"></td>
            <td><input type="text" name="checkout" class="left" value="16:30 น." readonly style="text-align:center;"></td>
            
            <td>
            <form action="check_time.php" method="post">
                <input type="text" name="time" id="time_to_table" hidden>
                <input class="left" type="text" name="note" id="" placeholder="หมายเหตุ (ถ้ามี)">
                <button style="margin-left: 3rem;" class="btn btn-info font-25">บันทึก</button>

            </form>
            </td>
        </tr>
    </table>


<script src="script.js"></script>
<!----------------------------- END BODY ----------------------------->

<?php
    require_once('component/footer.php');
?>