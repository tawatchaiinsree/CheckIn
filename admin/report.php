<?php
require_once('../files/tcpdf.php');
require("../config/mysql_connect.php");
session_start();

$pdf = new TCPDF('P', 'mm', array('210', '297'), true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tawatchai Insree');
$pdf->SetTitle('Result of serial of wiplux by Tawatchai');
$pdf->SetSubject('');
$pdf->SetKeywords('');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(10, 10, 10);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// print_r($_POST, $_SESSION);
if($_POST['user_type'] === '0'){
	$user_type = 'พนักงานทั้งหมด';
}else{
	$result = $conn->query("SELECT title FROM user_type WHERE id = '".$_POST['user_type']."'");
	while($row = $result->fetch_assoc()) {
		$user_type = $row['title'];
	}
}
// ---------------------------------------------------------
$pdf->AddPage();
$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$x = 5;
$y = 5;
$img_h = 26;
$img_w = 26;
$table_width = 196;
$table_height = 260;
$pdf->Image('../asset/img/icon.jpg', 210/2-8, $y-3, $img_w, $img_h, 'JPG', '', '', false, 300, '', false, false, 0, 0, false, false);
$html2 = '';
$count = 1;
	$result = $conn->query("SELECT * FROM check_time 
	INNER JOIN user ON user.username = check_time.username 
	INNER JOIN checktime_status ON checktime_status.id = check_time.checkin_status 
	WHERE check_time.date BETWEEN '2020-09-01' AND '2020-09-30' ORDER BY date");
	$old_date = '';
	$count_arr = 0;
	$month = ['','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายนน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน', 'ธันวาคม'];
	foreach ($result as $key => $value) {$count_arr ++;}
		foreach ($result as $key => $value) {
			$date = explode("-", $value['date']);
			$date = $date[2].' '.$month[intval($date[1])].' '.($date[0]+543);
			if($key != 0){
				if($old_date != $value['date']){
					$html3 = '</table>';
					$count-=1;
					$pdf->SetFont('thsarabun', '', 16);
					$pdf->writeHTML($html.$html2.$html3, true, false, true, false, '');
					$summary = "
				<table style=\"width: 36%;\">
					<tr>
						<td>ทั้งหมด</td>
						<td>$count</td>
					</tr>
					<tr>
						<td>มาปฏิบัติงาน</td>
						<td>39</td>
					</tr>
					<tr>
						<td>ไม่มา</td>
						<td>1</td>
					</tr>
					<tr>
						<td>สาย</td>
						<td>0</td>
					</tr>
				</table>	
				";
					$pdf->writeHTML($summary, true, false, true, false, '');
					$pdf->SetFont('thsarabun', 'b', 16);
					$pdf->SetXY($x+20, $y+42);
					$pdf->Write(0, "ลงชื่อ ...................................................", '', 0, 'R', true, 0, false, false, 0);
					$pdf->SetXY($x+20, $y+52);
					$pdf->Write(0, "(เจ้าพนักงานที่ดินจังหวัดสงขลา)", '', 0, 'R', true, 0, false, false, 0);
					$html2 = '';
					$count=1;
					// หน้าเก่า
					$pdf->AddPage();
					$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
					$x = 5;
					$y = 5;
					$img_h = 26;
					$img_w = 26;
					$table_width = 196;
					$table_height = 260;
					$pdf->Image('../asset/img/icon.jpg', 210/2-8, $y-3, $img_w, $img_h, 'JPG', '', '', false, 300, '', false, false, 0, 0, false, false);

					$pdf->SetFont('thsarabun', 'b', 16);
					$pdf->SetXY($x+13, $y+=$img_h-5);
					$pdf->Write(0, 'รายงานการลงเวลาปฏิบัติงาน', '', 0, 'C', true, 0, false, false, 0);
					$pdf->SetXY($x+13, $y+=7);
					$pdf->Write(0, "สำหรับ$user_type", '', 0, 'C', true, 0, false, false, 0);
					$pdf->SetXY($x+13, $y+=7);
					$pdf->Write(0, "วันที่ ".$date, '', 0, 'C', true, 0, false, false, 0);

					$html2.= "
				<tr>
					<td style=\"width: 10%;\">$count</td>
					<td style=\"width: 25%;\">".$value['pname'].$value['fname']." ".$value['lname']."</td>
					<td style=\"width: 15%;\">".$value['checkin_time']."</td>
					<td style=\"width: 15%;\">".$value['checkout_time']."</td>
					<td style=\"width: 20%;\">".$value['title']."</td>
					<td style=\"width: 15%;\">".$value['note1']." ".$value['note2']."</td>
				</tr>
				";
				$count++;
				$y+=5;
				}else{
					$html2.= "
				<tr>
					<td style=\"width: 10%;\">$count</td>
					<td style=\"width: 25%;\">".$value['pname'].$value['fname']." ".$value['lname']."</td>
					<td style=\"width: 15%;\">".$value['checkin_time']."</td>
					<td style=\"width: 15%;\">".$value['checkout_time']."</td>
					<td style=\"width: 20%;\">".$value['title']."</td>
					<td style=\"width: 15%;\">".$value['note1']." ".$value['note2']."</td>
				</tr>
				";
				$count++;
				$y+=5;
				}
				if($count==31){
					$html3 = '</table>';
					$pdf->SetFont('thsarabun', '', 16);
					$pdf->writeHTML($html.$html2.$html3, true, false, true, false, '');
					$html2 = '';
					$pdf->AddPage();
					$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
					$x = 5;
					$y = 5;
					$img_h = 26;
					$img_w = 26;
					$table_width = 196;
					$table_height = 260;
					$pdf->Image('../asset/img/icon.jpg', 210/2-8, $y-3, $img_w, $img_h, 'JPG', '', '', false, 300, '', false, false, 0, 0, false, false);
					$pdf->SetFont('thsarabun', 'b', 16);
					$pdf->SetXY($x+13, $y+=$img_h-5);
					$pdf->Write(0, 'รายงานการลงเวลาปฏิบัติงาน', '', 0, 'C', true, 0, false, false, 0);
					$pdf->SetXY($x+13, $y+=7);
					$pdf->Write(0, "สำหรับ$user_type", '', 0, 'C', true, 0, false, false, 0);
					$pdf->SetXY($x+13, $y+=7);
					$pdf->Write(0, "วันที่ ".$date, '', 0, 'C', true, 0, false, false, 0);

					$html = '
					<table border="1" style="text-align:center;">
						<tr>
							<th style="width: 10%;"><strong>ลำดับ</strong></th>
							<th style="width: 25%;"><strong>ชื่อ-นามสกุล</strong></th>
							<th style="width: 15%;"><strong>เวลาเข้า</strong></th>
							<th style="width: 15%;"><strong>เวลาออก</strong></th>
							<th style="width: 20%;"><strong>สถานะ</strong></th>
							<th style="width: 15%;"><strong>หมายเหตุ</strong></th>
						</tr>';
					$html2.= "
					<tr>
						<td style=\"width: 10%;\">$count</td>
						<td style=\"width: 25%;\">".$value['pname'].$value['fname']." ".$value['lname']."</td>
						<td style=\"width: 15%;\">".$value['checkin_time']."</td>
						<td style=\"width: 15%;\">".$value['checkout_time']."</td>
						<td style=\"width: 20%;\">".$value['title']."</td>
						<td style=\"width: 15%;\">".$value['note1']." ".$value['note2']."</td>
					</tr>
					";
					$count++;
					$y+=5;
				}
			}else{
				$pdf->SetFont('thsarabun', 'b', 16);
				$pdf->SetXY($x+13, $y+=$img_h-5);
				$pdf->Write(0, 'รายงานการลงเวลาปฏิบัติงาน', '', 0, 'C', true, 0, false, false, 0);
				$pdf->SetXY($x+13, $y+=7);
				$pdf->Write(0, "สำหรับ$user_type", '', 0, 'C', true, 0, false, false, 0);
				$pdf->SetXY($x+13, $y+=7);
				$pdf->Write(0, "วันที่ ".$date, '', 0, 'C', true, 0, false, false, 0);

				$html = '
				<table border="1" style="text-align:center;">
					<tr>
						<th style="width: 10%;"><strong>ลำดับ</strong></th>
						<th style="width: 25%;"><strong>ชื่อ-นามสกุล</strong></th>
						<th style="width: 15%;"><strong>เวลาเข้า</strong></th>
						<th style="width: 15%;"><strong>เวลาออก</strong></th>
						<th style="width: 20%;"><strong>สถานะ</strong></th>
						<th style="width: 15%;"><strong>หมายเหตุ</strong></th>
					</tr>';
				$html2.= "
				<tr>
					<td style=\"width: 10%;\">$count</td>
					<td style=\"width: 25%;\">".$value['pname'].$value['fname']." ".$value['lname']."</td>
					<td style=\"width: 15%;\">".$value['checkin_time']."</td>
					<td style=\"width: 15%;\">".$value['checkout_time']."</td>
					<td style=\"width: 20%;\">".$value['title']."</td>
					<td style=\"width: 15%;\">".$value['note1']." ".$value['note2']."</td>
				</tr>
				";
				$count++;
				$y+=5;
			}
			$old_date = $value['date'];
			if($count_arr-1 == $key){
				$html3 = '</table>';
				$count-=1;
				$pdf->SetFont('thsarabun', '', 16);
				$pdf->writeHTML($html.$html2.$html3, true, false, true, false, '');
				$summary = "
				<table style=\"width: 30%;\">
					<tr>
						<td>ทั้งหมด</td>
						<td>$count</td>
					</tr>
					<tr>
						<td>มาปฏิบัติงาน</td>
						<td>39</td>
					</tr>
					<tr>
						<td>ไม่มา</td>
						<td>1</td>
					</tr>
					<tr>
						<td>สาย</td>
						<td>0</td>
					</tr>
				</table>	
				";
				$pdf->writeHTML($summary, true, false, true, false, '');
					$pdf->SetFont('thsarabun', 'b', 16);
					$pdf->SetXY($x+20, $y+42);
					$pdf->Write(0, "ลงชื่อ ...................................................", '', 0, 'R', true, 0, false, false, 0);
					$pdf->SetXY($x+20, $y+52);
					$pdf->Write(0, "(เจ้าพนักงานที่ดินจังหวัดสงขลา)", '', 0, 'R', true, 0, false, false, 0);
				$html2 = '';
				$count=1;
			}
		}

date_default_timezone_set("Asia/Bangkok");
$pdf->Output('report'.date("Y-m-d H:i").'.pdf', 'I');
