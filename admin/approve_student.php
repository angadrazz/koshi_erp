<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$conn->query("UPDATE students SET admission_status='$status' WHERE id='$id'");

header("Location: students.php");
exit();
?>
