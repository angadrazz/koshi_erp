<?php
session_start();
include("../db.php");

if(!isset($_SESSION['superadmin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$conn->query("UPDATE users SET status='$status' WHERE id='$id'");

header("Location: admin_list.php");
exit();
?>
