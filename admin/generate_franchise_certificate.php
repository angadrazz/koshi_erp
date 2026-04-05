<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM franchise WHERE id='$id'");
if($res->num_rows==0){
  die("Invalid Franchise");
}
$row = $res->fetch_assoc();

if($row['certificate_no']!=""){
  header("Location: franchise_list.php");
  exit();
}

$cert_no = "KOSHI-FRAN-CERT-".date("Y").rand(1000,9999);

$conn->query("UPDATE franchise SET certificate_no='$cert_no' WHERE id='$id'");

header("Location: franchise_list.php");
exit();
?>
