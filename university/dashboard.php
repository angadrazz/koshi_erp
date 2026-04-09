<?php
session_start();
include("../db.php");

if(!isset($_SESSION['university'])){
  header("Location: ../login.php");
  exit();
}

$username = $_SESSION['university'];

$ures = $conn->query("SELECT * FROM users WHERE username='$username' AND role='university'");
$urow = $ures->fetch_assoc();

$uni_code = $urow['university_code'];

$total = $conn->query("SELECT COUNT(*) as t FROM students WHERE university_code='$uni_code'")->fetch_assoc()['t'];
$completed = $conn->query("SELECT COUNT(*) as t FROM students WHERE university_code='$uni_code' AND course_status='Completed'")->fetch_assoc()['t'];
$running = $conn->query("SELECT COUNT(*) as t FROM students WHERE university_code='$uni_code' AND course_status='Running'")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>University Dashboard</title>
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
  </style>
</head>
<body>

<div class="top">
  <a class="btn logout" href="logout.php">Logout</a>
  <h2>University Dashboard (<?php echo $uni_code; ?>)</h2>
  <span></span>
</div>

<div class="grid">
  <div class="card"><h3>Total Students</h3><p><?php echo $total; ?></p></div>
  <div class="card"><h3>Running Students</h3><p><?php echo $running; ?></p></div>
  <div class="card"><h3>Completed Students</h3><p><?php echo $completed; ?></p></div>
</div>

<div class="menu">
  <a class="blue" href="students.php">View Students</a>
</div>

</body>
</html>
