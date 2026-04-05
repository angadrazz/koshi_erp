<?php
session_start();
include("../db.php");

if(!isset($_SESSION['superadmin'])){
  header("Location: login.php");
  exit();
}

$uni = $conn->query("SELECT COUNT(*) as total FROM universities")->fetch_assoc()['total'];
$courses = $conn->query("SELECT COUNT(*) as total FROM courses")->fetch_assoc()['total'];
$admins = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='admin'")->fetch_assoc()['total'];
$students = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Super Admin Dashboard</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;text-align:center;}
    .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
    .btn{padding:10px 15px;background:#0b5cff;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
    .logout{background:red;}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:15px;}
    .card{background:white;padding:18px;border-radius:14px;box-shadow:0 10px 25px rgba(0,0,0,0.10);font-weight:bold;}
    .card h3{margin:0;color:#0b5cff;}
    .menu{margin-top:20px;text-align:center;}
    .menu a{display:inline-block;margin:8px;padding:12px 15px;background:green;color:white;border-radius:12px;text-decoration:none;font-weight:bold;}
    .menu a.blue{background:#0b5cff;}
    .menu a.orange{background:orange;}
  </style>
</head>
<body>

<div class="top">
  <a class="btn logout" href="logout.php">Logout</a>
  <h2>Super Admin Dashboard (All India Management)</h2>
  <span></span>
</div>

<div class="grid">
  <div class="card"><h3>Total Universities</h3><p><?php echo $uni; ?></p></div>
  <div class="card"><h3>Total Courses</h3><p><?php echo $courses; ?></p></div>
  <div class="card"><h3>Total Admins</h3><p><?php echo $admins; ?></p></div>
  <div class="card"><h3>Total Students</h3><p><?php echo $students; ?></p></div>
</div>

<div class="menu">
  <a class="blue" href="add_university.php">+ Add University</a>
  <a href="university_list.php">University List</a>
  <a class="orange" href="create_admin.php">Create Admin</a>
  <a href="admin_list.php">Admin List</a>
  <a class="blue" href="course_list.php">Course List</a>
</div>

</body>
</html>
