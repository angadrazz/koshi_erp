<?php
session_start();
include("../db.php");

if(!isset($_SESSION['coursemanager'])){
  header("Location: login.php");
  exit();
}

$total_courses = $conn->query("SELECT COUNT(*) as t FROM courses")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Course Manager Dashboard</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{text-align:center;color:#0b5cff;}
    .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
    .btn{padding:10px 15px;background:#0b5cff;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
    .logout{background:red;}
    .card{max-width:400px;margin:auto;background:white;padding:20px;border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,0.10);text-align:center;font-weight:bold;}
    .card h3{margin:0;color:#0b5cff;}
    .menu{text-align:center;margin-top:20px;}
    .menu a{display:inline-block;margin:8px;padding:12px 15px;background:green;color:white;border-radius:12px;text-decoration:none;font-weight:bold;}
    .menu a.blue{background:#0b5cff;}
  </style>
</head>
<body>

<div class="top">
  <a class="btn logout" href="logout.php">Logout</a>
  <h2>Course Manager Dashboard</h2>
  <span></span>
</div>

<div class="card">
  <h3>Total Courses</h3>
  <p style="font-size:22px;"><?php echo $total_courses; ?></p>
</div>

<div class="menu">
  <a class="blue" href="add_course.php">+ Add New Course</a>
  <a href="course_list.php">Course List</a>
</div>

</body>
</html>
