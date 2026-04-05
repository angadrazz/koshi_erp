<?php
include("db.php");
include("config.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$sres = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");
if($sres->num_rows==0){
  die("Student Not Found!");
}
$student = $sres->fetch_assoc();

$mres = $conn->query("SELECT * FROM marksheets WHERE reg_id='$reg'");
if($mres->num_rows==0){
  die("Marksheet Not Available!");
}
$marks = $mres->fetch_assoc();

$pdf = new FPDF("P","mm","A4");
$pdf->AddPage();

/* GOLD BORDER */
$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(2);
$pdf->Rect(10,10,190,277);

$pdf->SetLineWidth(1);
$pdf->Rect(14,14,182,269);

/* WATERMARK */
$pdf->SetFont("Arial","B",40);
$pdf->SetTextColor(245,245,245);
$pdf->SetXY(15,120);
$pdf->Cell(180,20,"KOSHI INSTITUTE",0,0,"C");

/* HEADER */
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,$SITE_NAME,0,1,"C");

$pdf->SetFont("Arial","B",11);
$pdf->Cell(0,6,$SITE_SUBTITLE,0,1,"C");

$pdf->SetFont("Arial","",9);
$pdf->Cell(0,5,$SITE_LINE1,0,1,"C");
$pdf->Cell(0,5,$SITE_LINE2,0,1,"C");
$pdf->Cell(0,5,$SITE_LINE3,0,1,"C");

$pdf->Ln(8);

/* TITLE */
$pdf->SetFont("Arial","B",20);
$pdf->SetTextColor(212,175,55);
$pdf->Cell(0,10,"MARKSHEET",0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->Ln(4);

/* STUDENT PHOTO */
if($student['photo']!=""){
  $photoPath = "uploads/".$student['photo'];
  if(file_exists($photoPath)){
    $pdf->Image($photoPath, 155, 65, 35, 40);
  }
}

/* STUDENT DETAILS */
$pdf->SetFont("Arial","B",11);
$pdf->Cell(45,8,"Student Name:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(90,8,$student['name'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->Cell(45,8,"Father Name:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(90,8,$student['father_name'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->Cell(45,8,"Registration ID:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(90,8,$student['reg_id'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->Cell(45,8,"Course Code:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(90,8,$student['course_code'],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->Cell(45,8,"University Code:",0,0);
$pdf->SetFont("Arial","",11);
$pdf->Cell(90,8,$student['university_code'],0,1);

$pdf->Ln(10);

/* MARKS TABLE */
$pdf->SetFont("Arial","B",12);
$pdf->SetFillColor(212,175,55);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(15,10,"S.No",1,0,"C",true);
$pdf->Cell(115,10,"Subject",1,0,"C",true);
$pdf->Cell(30,10,"Marks",1,0,"C",true);
$pdf->Cell(30,10,"Out Of",1,1,"C",true);

$pdf->SetFont("Arial","",11);
$pdf->SetFillColor(255,255,255);

/* SUBJECT 1 */
$pdf->Cell(15,10,"1",1,0,"C");
$pdf->Cell(115,10,$marks['subject1'],1,0);
$pdf->Cell(30,10,$marks['marks1'],1,0,"C");
$pdf->Cell(30,10,"100",1,1,"C");

/* SUBJECT 2 */
$pdf->Cell(15,10,"2",1,0,"C");
$pdf->Cell(115,10,$marks['subject2'],1,0);
$pdf->Cell(30,10,$marks['marks2'],1,0,"C");
$pdf->Cell(30,10,"100",1,1,"C");

/* SUBJECT 3 */
$pdf->Cell(15,10,"3",1,0,"C");
$pdf->Cell(115,10,$marks['subject3'],1,0);
$pdf->Cell(30,10,$marks['marks3'],1,0,"C");
$pdf->Cell(30,10,"100",1,1,"C");

/* SUBJECT 4 */
$pdf->Cell(15,10,"4",1,0,"C");
$pdf->Cell(115,10,$marks['subject4'],1,0);
$pdf->Cell(30,10,$marks['marks4'],1,0,"C");
$pdf->Cell(30,10,"100",1,1,"C");

/* SUBJECT 5 */
$pdf->Cell(15,10,"5",1,0,"C");
$pdf->Cell(115,10,$marks['subject5'],1,0);
$pdf->Cell(30,10,$marks['marks5'],1,0,"C");
$pdf->Cell(30,10,"100",1,1,"C");

/* TOTAL */
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,10,"TOTAL",1,0,"C");
$pdf->Cell(30,10,$marks['obtained_marks'],1,0,"C");
$pdf->Cell(30,10,$marks['total_marks'],1,1,"C");

$pdf->Ln(10);

/* RESULT STATUS */
$pdf->SetFont("Arial","B",14);
if($marks['result_status']=="Pass"){
  $pdf->SetTextColor(0,150,0);
} else {
  $pdf->SetTextColor(200,0,0);
}
$pdf->Cell(0,10,"RESULT: ".$marks['result_status'],0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

/* QR CODE */
$verify_link = $WEBSITE_URL."/verify.php?reg=".$student['reg_id'];
$qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link;
$pdf->Image($qr, 150, 240, 40, 40);

$pdf->SetFont("Arial","B",10);
$pdf->SetXY(145, 275);
$pdf->Cell(55,6,"Scan to Verify",0,0,"C");

/* SIGNATURE + SEAL */
$pdf->SetFont("Arial","B",12);
$pdf->SetXY(20,250);
$pdf->Cell(80,8,"_________________________",0,1);
$pdf->SetX(20);
$pdf->Cell(80,8,"Controller of Examination",0,1);

$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(2);
$pdf->Ellipse(60,265,40,18);

$pdf->SetFont("Arial","B",11);
$pdf->SetTextColor(212,175,55);
$pdf->SetXY(43,262);
$pdf->Cell(35,8,"OFFICIAL",0,1,"C");
$pdf->SetXY(43,268);
$pdf->Cell(35,8,"SEAL",0,1,"C");

$pdf->SetTextColor(0,0,0);

/* FOOTER */
$pdf->SetFont("Arial","I",9);
$pdf->SetXY(0,285);
$pdf->Cell(0,5,"This marksheet is digitally generated and valid only after QR verification.",0,0,"C");

$pdf->Output();
?>
