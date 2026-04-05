<?php
include("db.php");
include("config.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg' AND receipt_no!=''");
if($res->num_rows==0){
  die("Receipt Not Available!");
}

$row = $res->fetch_assoc();

$pdf = new FPDF("P","mm","A4");
$pdf->AddPage();

/* GOLD BORDER */
$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(2);
$pdf->Rect(10,10,190,277);

$pdf->SetLineWidth(1);
$pdf->Rect(14,14,182,269);

/* HEADER */
$pdf->SetFont("Arial","B",16);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,10,$SITE_NAME,0,1,"C");

$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,7,$SITE_SUBTITLE,0,1,"C");

$pdf->SetFont("Arial","",9);
$pdf->Cell(0,6,$SITE_LINE1,0,1,"C");
$pdf->Cell(0,6,$SITE_LINE2,0,1,"C");
$pdf->Cell(0,6,$SITE_LINE3,0,1,"C");

$pdf->Ln(10);

/* TITLE */
$pdf->SetFont("Arial","B",18);
$pdf->SetTextColor(212,175,55);
$pdf->Cell(0,10,"PAYMENT RECEIPT",0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

/* RECEIPT DETAILS */
$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"Receipt No:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['receipt_no'],0,1);

$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"Receipt Date:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['receipt_date'],0,1);

$pdf->Ln(5);

/* STUDENT DETAILS */
$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"Student Name:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['name'],0,1);

$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"Father Name:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['father_name'],0,1);

$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"Registration ID:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['reg_id'],0,1);

$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"Course Code:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['course_code'],0,1);

$pdf->SetFont("Arial","B",12);
$pdf->Cell(50,8,"University Code:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(0,8,$row['university_code'],0,1);

$pdf->Ln(8);

/* PAYMENT TABLE */
$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,10,"Description",1,0,"C");
$pdf->Cell(50,10,"Amount",1,1,"C");

$pdf->SetFont("Arial","",12);
$pdf->Cell(130,10,"Course Admission Fees",1,0);
$pdf->Cell(50,10,"Rs. ".$row['fee_paid'],1,1,"C");

$pdf->SetFont("Arial","B",12);
$pdf->Cell(130,10,"Total Paid",1,0);
$pdf->Cell(50,10,"Rs. ".$row['fee_paid'],1,1,"C");

$pdf->Ln(15);

/* QR CODE */
$verify_link = $WEBSITE_URL."/verify.php?reg=".$row['reg_id'];
$qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link;
$pdf->Image($qr, 150, 230, 35, 35);

$pdf->SetFont("Arial","B",10);
$pdf->SetXY(140, 265);
$pdf->Cell(60,6,"Scan to Verify",0,0,"C");

/* SIGNATURE */
$pdf->SetXY(15,245);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(80,8,"Authorized Signatory",0,1);

$pdf->SetFont("Arial","",10);
$pdf->Cell(80,6,"Payment Status: ".$row['payment_status'],0,1);

$pdf->Output();
?>
