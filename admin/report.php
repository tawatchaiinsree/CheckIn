<?php
require_once('./files/tcpdf.php');

// create new PDF document
$pdf = new TCPDF('P', 'mm', array('210', '297'), true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tawatchai Insree');
$pdf->SetTitle('Result of serial of wiplux by Tawatchai');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, 10, 15);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->AddPage();
$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$x = 5;
$y = 5;
$img_h = 32;
$img_w = 32;
$table_width = 196;
$table_height = 260;
$pdf->Image('logo.jpg', $x, $y, $img_w, $img_h, 'JPG', '', '', false, 300, '', false, false, 0, 0, false, false);
$pdf->SetFont('thsarabun', 'b', 14);
$pdf->SetXY($x, $y);
$pdf->Write(0, 'ต้นฉบับใบเสร็จรับเงิน', '', 0, 'R', true, 0, false, false, 0);
$pdf->SetFont('thsarabun', '', 10);
$pdf->SetXY($x, $y+5);
$pdf->Write(0, '(เอกสารออกเป็นชุด)', '', 0, 'R', true, 0, false, false, 0);

$pdf->SetFont('thsarabun', 'b', 12);
$pdf->SetXY($x+$img_h+3, $y);
$pdf->Write(0, 'บริษัท บลา บลา บลา จำกัด', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetXY($x+$img_h+3, $y+=5);
$pdf->Write(0, '133 หมู่ที่ 8 ตำบลท่าช้าง อำเภอบางกล่ำ จังหวัดสงขลา 90110', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetXY($x+$img_h+3, $y+=5);
$pdf->Write(0, 'โทร (074) 414-414-20 แฟกซ์ (074) 414-421', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetXY($x+$img_h+3, $y+=5);
$pdf->Write(0, 'เลขประจำตัวผู้เสียภาษี 0905559003222', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetXY($x, $y);
$pdf->Write(0, 'ออกใบกำกับภาษีโดย 00000 สำนักงานใหญ่', '', 0, 'R', true, 0, false, false, 0);

$pdf->RoundedRect(5, $y+=8, $table_width, $table_height, 3, '1111', null); //กรอบนอก นุ่มใน

$pdf->RoundedRect(5, $y, $table_width/2, 32, 3, '0001', null);
$pdf->SetFont('thsarabun', '', 10);
$pdf->SetXY($x, $y+2);
$pdf->Write(0, 'ชื่อผู้ซื้อ', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetXY($x, $y+10);
$pdf->Write(0, 'ที่อยู่', '', 0, 'L', true, 0, false, false, 0);
//4 ซ้าย
$pdf->RoundedRect($x+$table_width/2, $y, $table_width/4, 8, 3, '0000', null);
$pdf->SetXY($x+$table_width/2, $y+2);
$pdf->Write(0, 'วันที่', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2, $y+8, $table_width/4, 8, 3, '0000', null);
$pdf->SetXY($x+$table_width/2, $y+10);
$pdf->Write(0, 'รหัสลูกค้า', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2, $y+16, $table_width/4, 8, 3, '0000', null);
$pdf->SetXY($x+$table_width/2, $y+18);
$pdf->Write(0, 'พนักงานขาย', '', 0, 'L', true, 0, false, false, 0);
$pdf->RoundedRect($x+$table_width/2, $y+24, $table_width/4, 8, 3, '0000', null);
//4 ขวา
$pdf->RoundedRect($x+$table_width-$table_width/4, $y, $table_width/4, 8, 3, '1000', null);
$pdf->SetXY($x+$table_width-$table_width/4, $y+2);
$pdf->Write(0, 'เลขที่บิล', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width-$table_width/4, $y+8, $table_width/4, 8, 3, '0000', null);
$pdf->SetXY($x+$table_width-$table_width/4, $y+10);
$pdf->Write(0, 'หน้าที่', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width-$table_width/4, $y+16, $table_width/4, 8, 3, '0000', null);
$pdf->SetXY($x+$table_width-$table_width/4, $y+18);
$pdf->Write(0, 'เงื่อนไขชำระเงิน                              วัน', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width-$table_width/4, $y+24, $table_width/4, 8, 3, '0000', null);
$pdf->SetXY($x+$table_width-$table_width/4, $y+26);
$pdf->Write(0, 'ครบกำหนดชำระ                             วัน', '', 0, 'L', true, 0, false, false, 0);

//โครงตารางล่าง
$h = 160;
$sm_w = 10;
$lg_w = 22;
$md_w = 22;
$y += 32;
$pdf->RoundedRect($x, $y, $table_width, 8, 3, '0000', null);
$pdf->RoundedRect($x, $y, $sm_w, $h, 3, '0000', null);
$pdf->SetFont('thsarabun', '', 12);
$pdf->SetXY($x+1, $y+1);
$pdf->Write(0, 'ก.พ.', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+10, $y, $sm_w, $h, 3, '0000', null);
$pdf->SetXY($x+11, $y+1);
$pdf->Write(0, 'ลำดับ', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+20, $y, $table_width/2-20, $h, 3, '0000', null);
$pdf->SetXY($x+$table_width/4, $y+1);
$pdf->Write(0, 'รายการ', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2, $y, $sm_w, $h, 3, '0000', null);
$pdf->SetXY($x+$table_width/2+1, $y+1);
$pdf->Write(0, 'บรรจุ', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2+$sm_w, $y, $lg_w, $h, 3, '0000', null);
$pdf->SetXY($x+$table_width/2+$sm_w+6, $y+1);
$pdf->Write(0, 'จำนวน', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2+$sm_w+$lg_w, $y, $md_w, $h, 3, '0000', null);
$pdf->SetXY($x+$table_width/2+3+$sm_w+$lg_w, $y+1);
$pdf->Write(0, 'ราคา/หน่วย', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2+$sm_w+$lg_w+$md_w, $y, $lg_w, $h, 3, '0000', null);
$pdf->SetXY($x+$table_width/2+3+$sm_w+$lg_w+$md_w, $y+1);
$pdf->Write(0, 'ส่วนลด/หน่วย', '', 0, 'L', true, 0, false, false, 0);

$pdf->RoundedRect($x+$table_width/2+$sm_w+$lg_w*2+$md_w, $y, $md_w, $h, 3, '0000', null);
$pdf->SetXY($x+$table_width/2+3+$sm_w+$lg_w+$md_w+21, $y+1);
$pdf->Write(0, 'จำนวนเงิน', '', 0, 'L', true, 0, false, false, 0);
//จบ TH
date_default_timezone_set("Asia/Bangkok");
$pdf->Output('report'.date("Y-m-d H:i").'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
