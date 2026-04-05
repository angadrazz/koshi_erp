<?php
include("db.php");
include("config.php");
require("fpdf/fpdf.php");

$fid = $_GET['fid'];

$res = $conn->query("SELECT * FROM franchise WHERE franchise_id='$fid' AND status='Approved'");
if($res->num_rows==0){
  die("Franchise Not Found / Not Approved!");
}

$row = $res->fetch_assoc();

if($row['certificate_no']==""){
  die("Certificate Not Generated Yet!");
}

$pdf = new FPDF("L","mm","A4");
$pdf->AddPage();

/* GOLD BORDER */
$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(3);
$pdf->Rect(10,10,277,190);
$pdf->SetLineWidth(1);
$pdf->Rect(14,14,269,182);

/* HEADER */
$pdf->SetFont("Arial","B",22);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,15,$SITE_NAME,0,1,"C");

$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,8,$SITE_SUBTITLE,0,1,"C");

$pdf->SetFont("Arial","",11);
$pdf->Cell(0,7,$SITE_LINE1,0,1,"C");
$pdf->Cell(0,7,$SITE_LINE2,0,1,"C");
$pdf->Cell(0,7,$SITE_LINE3,0,1,"C");

$pdf->Ln(8);

/* TITLE */
$pdf->SetFont("Arial","B",26);
$pdf->SetTextColor(212,175,55);
$pdf->Cell(0,15,"FRANCHISE AUTHORIZATION CERTIFICATE",0,1,"C");

$pdf->Ln(8);

/* BODY */
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","",15);

$text = "This is to certify that ".$row['name']." is hereby authorized as an official Franchise Partner of
Koshi Institute of Higher Education for the region of ".$row['city'].", ".$row['district'].", ".$row['state'].".";

$pdf->MultiCell(0,10,$text,0,"C");

$pdf->Ln(5);

$pdf->SetFont("Arial","B",14);
$pdf->Cell(0,10,"Franchise ID: ".$row['franchise_id']."     |     Certificate No: ".$row['certificate_no'],0,1,"C");

$pdf->Ln(10);

/* QR Verification */
$verify_link = $WEBSITE_URL."/franchise_verify.php?fid=".$row['franchise_id'];
$qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link;

$pdf->Image($qr, 240, 130, 40, 40);
$pdf->SetXY(235, 170);
$pdf->SetFont("Arial","B",10);
$pdf->Cell(55,8,"Scan to Verify",0,0,"C");

/* SIGNATURE */
$pdf->SetXY(30,160);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(80,10,"Director / Principal",0,0,"L");

$pdf->SetXY(30,170);
$pdf->SetFont("Arial","",11);
$pdf->Cell(80,7,"(Authorized Signatory)",0,0,"L");

$pdf->SetXY(180,160);
$pdf->SetFont("Arial","B",14);
$pdf->Cell(80,10,"Seal & Stamp",0,0,"R");

$pdf->SetXY(180,170);
$pdf->SetFont("Arial","",11);
$pdf->Cell(80,7,"Issue Date: ".date("d-m-Y"),0,0,"R");

$pdf->Output();
?>
