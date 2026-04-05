<?php
session_start();
include("../db.php");
include("../mail_config.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM students WHERE id='$id'");
if($res->num_rows==0){
  die("Invalid Student");
}
$row = $res->fetch_assoc();

if($row['certificate_no']!=""){
  header("Location: students.php");
  exit();
}

$cert_no = "KOSHI-CERT-".date("Y").rand(1000,9999);
$issue_date = date("d-m-Y");

$conn->query("UPDATE students SET certificate_no='$cert_no', course_status='Completed' WHERE id='$id'");
$conn->query("INSERT INTO certificates(reg_id, certificate_no, issue_date, status) VALUES('".$row['reg_id']."','$cert_no','$issue_date','Generated')");

/* EMAIL NOTIFICATION */
if($row['email']!=""){
  $sub = "Certificate Generated - Koshi Institute";
  $msg = "
  <h2>Certificate Generated Successfully</h2>
  <p>Hello <b>".$row['name']."</b>,</p>
  <p>Your Certificate has been generated.</p>
  <p><b>Certificate No:</b> ".$cert_no."</p>
  <p><b>Registration ID:</b> ".$row['reg_id']."</p>
  <p>Download Certificate:</p>
  <a href='https://koshiinstitute.org/certificate_pdf.php?reg=".$row['reg_id']."'>Download Certificate</a>
  <br><br>
  <p>Regards,<br>Koshi Institute</p>
  ";
  sendMail($row['email'],$sub,$msg);
}

header("Location: students.php");
exit();
?>
