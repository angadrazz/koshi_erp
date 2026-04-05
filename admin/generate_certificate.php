<?php
session_start();
include("../db.php");

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
$conn->query("INSERT INTO certificates(reg_id, certificate_no, issue_date, status)
VALUES('".$row['reg_id']."','$cert_no','$issue_date','Generated')");

header("Location: students.php");
exit();
?>
