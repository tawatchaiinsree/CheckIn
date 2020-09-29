<?php
require_once('../files/tcpdf.php');
require("../config/mysql_connect.php");
session_start();

$pdf = new TCPDF('P', 'mm', array('210', '297'), true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('รายงานการลงเวลาปฏิบัติงาน');
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
	$user_type = 'ข้าราชการทั้งหมด';
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
if($_POST['user_type'] != '0'){
	$result = $conn->query("SELECT *, check_time.id ids, checktime_status.id idc FROM user
	LEFT JOIN check_time ON user.username = check_time.username
	LEFT JOIN checktime_status ON checktime_status.id = check_time.checkin_status
	WHERE check_time.date = '".$_POST['start_date']."' AND user.type = '".$_POST['user_type']."' AND user.permission = 'user'
	");
}else{
	$result = $conn->query("SELECT *, check_time.id ids, checktime_status.id idc FROM user
	LEFT JOIN check_time ON user.username = check_time.username
	LEFT JOIN checktime_status ON checktime_status.id = check_time.checkin_status
	WHERE check_time.date = '".$_POST['start_date']."' AND user.permission = 'user'");
}
	$come_count = 0;
	$no_come_count=0;
	$late_count = 0;
	$month = ['','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายนน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน', 'ธันวาคม'];
	$date = explode("-", $_POST['start_date']);
	$date = intval($date[2]).' '.$month[intval($date[1])].' '.($date[0]+543);
	$count_arr = 0;
	$first_id = '';
	$pdf->SetFont('thsarabun', 'b', 16);
				$pdf->SetXY($x+13, $y+=$img_h-5);
				$pdf->Write(0, 'รายงานการลงเวลาปฏิบัติงาน', '', 0, 'C', true, 0, false, false, 0);
				$pdf->SetXY($x+13, $y+=7);
				$pdf->Write(0, "สำหรับ$user_type", '', 0, 'C', true, 0, false, false, 0);
				$pdf->SetXY($x+13, $y+=7);
				$pdf->Write(0, "วันที่ ".$date, '', 0, 'C', true, 0, false, false, 0);
				if ($result->num_rows > 0) {
				$html = '
				<table border="1" style="text-align:center;">
					<tr>
						<th style="width: 10%;"><strong>ลำดับ</strong></th>
						<th style="width: 25%;"><strong>ชื่อ-นามสกุล</strong></th>
						<th style="width: 15%;"><strong>เวลาเข้า</strong></th>
						<th style="width: 15%;"><strong>เวลาออก</strong></th>
						<th style="width: 10%;"><strong>ลายเซ็น</strong></th>
						<th style="width: 10%;"><strong>สถานะ</strong></th>
						<th style="width: 10%;"><strong>หมายเหตุ</strong></th>
					</tr>';
				}
					if ($result->num_rows == 0) {
						$html2 = '<h2>ไม่พบข้อมูล</h2>';
					}
	foreach ($result as $key => $value) {$count_arr ++;}
		foreach ($result as $key => $value) {
			if($key == 0){
				$first_id = $value['ids'];
			}
			if($value['idc'] == '2'){
				$late_count++;
			}
			if($count==16){
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
						<th style="width: 10%;"><strong>ลายเซ็น</strong></th>
						<th style="width: 10%;"><strong>สถานะ</strong></th>
						<th style="width: 10%;"><strong>หมายเหตุ</strong></th>
					</tr>';
			}
				$html2.= "
				<tr>
					<td style=\"width: 10%;\">$count</td>
					<td style=\"width: 25%;\">".$value['pname'].$value['fname']." ".$value['lname']."</td>
					<td style=\"width: 15%;\">".$value['checkin_time']."</td>
					<td style=\"width: 15%;\">".$value['checkout_time']."</td>
					<td style=\"width: 10%;\"></td>
					<td style=\"width: 10%;\">".$value['title']."</td>
					<td style=\"width: 10%;\">".$value['note1']." ".$value['note2']."</td>
				</tr>
				";
				$count++;
				$come_count++;
				$y+=5;
		}
$result = $conn->query("SELECT * FROM user      
WHERE permission='user' AND username NOT IN (SELECT username FROM check_time WHERE date = '".$_POST['start_date']."' AND check_time.checkin_status = '1')");
foreach ($result as $key => $value) {
	if($count==26){
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
				<th style="width: 10%;"><strong>ลายเซ็น</strong></th>
				<th style="width: 10%;"><strong>สถานะ</strong></th>
				<th style="width: 10%;"><strong>หมายเหตุ</strong></th>
			</tr>';
	}
	$html2.= "
	<tr>
		<td style=\"width: 10%;\">$count</td>
		<td style=\"width: 25%;\">".$value['pname'].$value['fname']." ".$value['lname']."</td>
		<td style=\"width: 15%;\">-</td>
		<td style=\"width: 15%;\">-</td>
		<td style=\"width: 10%;\"></td>
		<td style=\"width: 10%;\">ไม่มา</td>
		<td style=\"width: 10%;\"></td>
	</tr>
	";
	$count++;
	$no_come_count++;
	$y+=5;
}

$html3 = '</table>';
$count-=1;
$pdf->SetFont('thsarabun', '', 16);
$pdf->writeHTML($html.$html2.$html3, true, false, true, false, '');
if ($result->num_rows > 0) {
	$count = $count-$come_count+1;
	$no_come_count = $no_come_count-$come_count+1;
$summary = "
<table style=\"width: 40%;\">
<tr><td style=\"width: 45%;\">ข้าราชการทั้งหมด</td><td style=\"width: 35%;\">...................</td><td style=\"width: 20%;\">คน</td></tr>
<tr><td>อัตราว่าง</td><td>...................</td><td>คน</td></tr>
<tr><td>ยืมตัวมาช่วยราชการ</td><td>...................</td><td>คน</td></tr>
<tr><td>มาปฏิบัติราชการ</td><td>...................</td><td>คน</td></tr>
<tr><td>ไม่มา</td><td>...................</td><td>คน</td></tr>
<tr><td>มาสาย</td><td>...................</td><td>คน</td></tr>
<tr><td>ไปราชการ</td><td>...................</td><td>คน</td></tr>
</table>	
";
$pdf->writeHTML($summary, true, false, true, false, '');
	$pdf->SetFont('thsarabun', '', 16);
	$y+=8;
	$pdf->SetXY($x+20, $y+42);
	$pdf->Write(0, "ผู้ตรวจ .................................................................", '', 0, 'R', true, 0, false, false, 0);
	$pdf->SetXY($x+15, $y+49);
	$pdf->Write(0, "(หัวหน้าหน่วยงานผู้รับผิดชอบงานการเจ้าหน้าที่)", '', 0, 'R', true, 0, false, false, 0);
}
$html2 = '';
$count=1;

date_default_timezone_set("Asia/Bangkok");
$pdf->Output('report'.date("Y-m-d H:i").'.pdf', 'I');
