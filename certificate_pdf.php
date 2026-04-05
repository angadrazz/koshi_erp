<?php
include("db.php");
include("config.php");
require("fpdf/fpdf.php");

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg' AND certificate_no!=''");
if($res->num_rows==0){
  die("Certificate Not Found / Not Generated!");
}
$row = $res->fetch_assoc();

$cert_no = $row['certificate_no'];
$issue_date = date("d-m-Y");

$pdf = new FPDF("L","mm","A4");
$pdf->AddPage();

/* GOLD BORDER */
$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(3);
$pdf->Rect(8,8,281,192);

$pdf->SetLineWidth(1);
$pdf->Rect(13,13,271,182);

/* BACKGROUND LIGHT WATERMARK */
$pdf->SetFont("Arial","B",55);
$pdf->SetTextColor(240,240,240);
$pdf->SetXY(30,90);
$pdf->Cell(0,20,"KOSHI INSTITUTE",0,0,"C");

/* HEADER */
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","B",22);
$pdf->SetXY(0,20);
$pdf->Cell(0,10,$SITE_NAME,0,1,"C");

$pdf->SetFont("Arial","B",13);
$pdf->Cell(0,7,$SITE_SUBTITLE,0,1,"C");

$pdf->SetFont("Arial","",10);
$pdf->Cell(0,6,$SITE_LINE1,0,1,"C");
$pdf->Cell(0,6,$SITE_LINE2,0,1,"C");
$pdf->Cell(0,6,$SITE_LINE3,0,1,"C");

$pdf->Ln(8);

/* CERTIFICATE TITLE */
$pdf->SetFont("Arial","B",28);
$pdf->SetTextColor(212,175,55);
$pdf->Cell(0,12,"CERTIFICATE OF COMPLETION",0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->Ln(8);

/* MAIN TEXT */
$pdf->SetFont("Arial","",14);
$pdf->SetX(20);
$pdf->MultiCell(250,9,
"This is to certify that the student mentioned below has successfully completed the course program under Koshi Institute of Higher Education and has fulfilled all academic requirements.",
0,"C");

$pdf->Ln(10);

/* STUDENT NAME */
$pdf->SetFont("Arial","B",24);
$pdf->SetTextColor(0,0,80);
$pdf->Cell(0,10,strtoupper($row['name']),0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","",14);
$pdf->Cell(0,8,"S/o / D/o : ".$row['father_name'],0,1,"C");

$pdf->Ln(6);

/* COURSE + UNIVERSITY */
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,9,"Course: ".$row['course_code']." | University: ".$row['university_code'],0,1,"C");

$pdf->Ln(10);

/* CERTIFICATE DETAILS */
$pdf->SetFont("Arial","B",12);
$pdf->SetX(25);
$pdf->Cell(60,8,"Certificate No:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(80,8,$cert_no,0,0);

$pdf->SetFont("Arial","B",12);
$pdf->Cell(40,8,"Issue Date:",0,0);
$pdf->SetFont("Arial","",12);
$pdf->Cell(50,8,$issue_date,0,1);

$pdf->Ln(10);

/* STUDENT PHOTO */
if($row['photo']!=""){
  $photoPath = "uploads/".$row['photo'];
  if(file_exists($photoPath)){
    $pdf->Image($photoPath, 25, 125, 35, 40);
  }
}

/* QR CODE (VERIFY LINK) */
$verify_link = $WEBSITE_URL."/verify.php?reg=".$row['reg_id'];
$qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$verify_link;
$pdf->Image($qr, 245, 125, 40, 40);

$pdf->SetFont("Arial","B",10);
$pdf->SetXY(240, 168);
$pdf->Cell(55,6,"Scan to Verify",0,0,"C");

/* SIGNATURE BOX */
$pdf->SetFont("Arial","B",12);
$pdf->SetXY(110, 150);
$pdf->Cell(80,8,"_________________________",0,1,"C");
$pdf->SetXY(110, 158);
$pdf->Cell(80,8,"Authorized Signature",0,1,"C");

/* SEAL */
$pdf->SetDrawColor(212,175,55);
$pdf->SetLineWidth(2);
$pdf->Ellipse(140,165,35,20);
$pdf->SetFont("Arial","B",12);
$pdf->SetTextColor(212,175,55);
$pdf->SetXY(122,162);
$pdf->Cell(36,8,"OFFICIAL",0,1,"C");
$pdf->SetXY(122,168);
$pdf->Cell(36,8,"SEAL",0,1,"C");

/* FOOTER */
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","I",10);
$pdf->SetXY(0,188);
$pdf->Cell(0,6,"This certificate is digitally generated and valid only after QR verification.",0,0,"C");

$pdf->Output();
?>
