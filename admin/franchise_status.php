<?php
session_start();
include("../db.php");
include("../mail_config.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$res = $conn->query("SELECT * FROM franchise WHERE id='$id'");
$row = $res->fetch_assoc();

$conn->query("UPDATE franchise SET status='$status' WHERE id='$id'");

/* EMAIL NOTIFICATION */
if($row['email']!=""){
  $sub = "Franchise Application Status - Koshi Institute";
  $msg = "
  <h2>Franchise Status Updated</h2>
  <p>Hello <b>".$row['name']."</b>,</p>
  <p>Your Franchise Application Status is:</p>
  <h3 style='color:green;'>".$status."</h3>
  <p><b>Franchise ID:</b> ".$row['franchise_id']."</p>
  <p>Login: https://koshiinstitute.org/franchise/login.php</p>
  <br>
  <p>Regards,<br>Koshi Institute of Higher Education</p>
  ";
  sendMail($row['email'],$sub,$msg);
}

header("Location: franchise_list.php");
exit();
?>
