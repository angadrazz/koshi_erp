<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: ../login.php");
  exit();
}

$total_students = $conn->query("SELECT COUNT(*) as t FROM students")->fetch_assoc()['t'];
$pending_students = $conn->query("SELECT COUNT(*) as t FROM students WHERE admission_status='Pending'")->fetch_assoc()['t'];
$approved_students = $conn->query("SELECT COUNT(*) as t FROM students WHERE admission_status='Approved'")->fetch_assoc()['t'];

$pending_franchise = $conn->query("SELECT COUNT(*) as t FROM franchise WHERE status='Pending'")->fetch_assoc()['t'];
$enquiries = $conn->query("SELECT COUNT(*) as t FROM enquiries")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - Koshi ERP</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{text-align:center;color:#0b5cff;}
    .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
    .btn{padding:10px 15px;background:#0b5cff;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
    .logout{background:red;}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:15px;}
    .card{background:white;padding:18px;border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,0.10);font-weight:bold;}
    .card h3{margin:0;color:#0b5cff;}
    .menu{text-align:center;margin-top:20px;}
    .menu a{display:inline-block;margin:8px;padding:12px 15px;background:green;color:white;border-radius:12px;text-decoration:none;font-weight:bold;}
    .menu a.blue{background:#0b5cff;}
    .menu a.orange{background:orange;}
    .menu a.red{background:red;}
  </style>
</head>
<body>

<div class="top">
  <a class="btn logout" href="logout.php">Logout</a>
  <h2>Admin Dashboard (Koshi ERP)</h2>
  <span></span>
</div>

<div class="grid">
  <div class="card"><h3>Total Students</h3><p><?php echo $total_students; ?></p></div>
  <div class="card"><h3>Pending Admissions</h3><p><?php echo $pending_students; ?></p></div>
  <div class="card"><h3>Approved Admissions</h3><p><?php echo $approved_students; ?></p></div>
  <div class="card"><h3>Enquiries</h3><p><?php echo $enquiries; ?></p></div>
  <div class="card"><h3>Pending Franchise</h3><p><?php echo $pending_franchise; ?></p></div>
</div>

<div class="menu">
  <a class="blue" href="students.php">Manage Students</a>
  <a href="enquiry_list.php">Admission Enquiries</a>
  <a class="orange" href="franchise_list.php">Franchise Requests</a>
  <a class="blue" href="export_excel.php">Export Students Excel</a>
</div>

</body>
</html>
