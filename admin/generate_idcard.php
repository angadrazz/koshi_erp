<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$reg = $_GET['reg'];

$conn->query("UPDATE students SET idcard_status='Generated', student_id=CONCAT('KOSHI-ID-',YEAR(CURDATE()),FLOOR(RAND()*9000+1000))
WHERE reg_id='$reg'");

header("Location: students.php");
exit();
?>
