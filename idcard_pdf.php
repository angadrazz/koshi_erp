<?php
include("db.php");
include("config.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg' AND idcard_status='Generated'");
if($res->num_rows==0){
  die("ID Card Not Available / Not Generated!");
}
$row = $res->fetch_assoc();

$student_id = $row['student_id'];
if($student_id==""){
  $student_id = "KOSHI-ID-".date("Y").rand(1000,9999);
}

$pdf = new FPDF("P","mm","A4");
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

/* CARD DIMENSION */
$x = 30;
$y = 60;
$w = 150;
$h = 95;

/* GOLD BORDER */
$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(2);
$pdf->RoundedRect($x, $y, $w, $h, 6, 'D');

/* INNER BORDER */
$pdf->SetLineWidth(0.5);
$pdf->RoundedRect($x+2, $y+2, $w-4, $h-4, 6, 'D');

/* HEADER BACKGROUND */
$pdf->SetFillColor(0,31,77);
$pdf->Rect($x+2, $y+2, $w-4, 18, "F");

/* HEADER TEXT */
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",11);
$pdf->SetXY($x, $y+6);
$pdf->Cell($w,6,"KOSHI INSTITUTE OF HIGHER EDUCATION",0,1,"C");

$pdf->SetFont("Arial","",8);
$pdf->SetXY($x, $y+12);
$pdf->Cell($w,6,"(A Unit of Koshi Shiksha Private Limited)",0,1,"C");

/* BODY TEXT COLOR */
$pdf->SetTextColor(0,0,0);

/* STUDENT PHOTO */
if($row['photo']!=""){
  $photoPath = "uploads/".$row['photo'];
  if(file_exists($photoPath)){
    $pdf->Image($photoPath, $x+7, $y+27, 28, 32);
  }
}

/* STUDENT DETAILS */
$pdf->SetFont("Arial","B",10);
$pdf->SetXY($x+40, $y+25);
$pdf->Cell(40,6,"Name:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,$row['name'],0,1);

$pdf->SetFont("Arial","B",10);
$pdf->SetX($x+40);
$pdf->Cell(40,6,"Reg ID:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,$row['reg_id'],0,1);

$pdf->SetFont("Arial","B",10);
$pdf->SetX($x+40);
$pdf->Cell(40,6,"Student ID:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,$student_id,0,1);

$pdf->SetFont("Arial","B",10);
$pdf->SetX($x+40);
$pdf->Cell(40,6,"Course:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,$row['course_code'],0,1);

$pdf->SetFont("Arial","B",10);
$pdf->SetX($x+40);
$pdf->Cell(40,6,"University:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,$row['university_code'],0,1);

$pdf->SetFont("Arial","B",10);
$pdf->SetX($x+40);
$pdf->Cell(40,6,"Mobile:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,$row['mobile'],0,1);

/* VALIDITY */
$pdf->SetFont("Arial","B",10);
$pdf->SetXY($x+7, $y+65);
$pdf->Cell(60,6,"Valid Till:",0,0);
$pdf->SetFont("Arial","",10);
$pdf->Cell(60,6,date("d-m-Y", strtotime("+2 years")),0,1);

/* QR CODE */
$verify_link = $WEBSITE_URL."/verify.php?reg=".$row['reg_id'];
$qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link;
$pdf->Image($qr, $x+110, $y+60, 30, 30);

$pdf->SetFont("Arial","B",7);
$pdf->SetXY($x+105, $y+90);
$pdf->Cell(40,5,"Scan to Verify",0,0,"C");

/* SIGNATURE */
$pdf->SetFont("Arial","B",9);
$pdf->SetXY($x+10, $y+82);
$pdf->Cell(70,6,"Authorized Signature",0,1);

$pdf->SetXY($x+10, $y+78);
$pdf->Cell(70,6,"_____________________",0,1);

/* GOLD FOOTER STRIP */
$pdf->SetFillColor(212,175,55);
$pdf->Rect($x+2, $y+$h-12, $w-4, 10, "F");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",8);
$pdf->SetXY($x, $y+$h-11);
$pdf->Cell($w,6,"ISO 9001:2015 | MSME Registered | MCA Registered",0,0,"C");

$pdf->Output();
?>
