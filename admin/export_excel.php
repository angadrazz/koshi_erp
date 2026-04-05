<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=students_export.xls");

echo "RegID\tName\tMobile\tCourse\tUniversity\tAdmission\tPayment\tCertificate\tStudentID\tDate\n";

$res = $conn->query("SELECT * FROM students ORDER BY id DESC");
while($row = $res->fetch_assoc()){
  echo $row['reg_id']."\t".$row['name']."\t".$row['mobile']."\t".$row['course_code']."\t".$row['university_code']."\t".$row['admission_status']."\t".$row['payment_status']."\t".$row['certificate_no']."\t".$row['student_id']."\t".$row['created_at']."\n";
}
?>
