<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$total_students = $conn->query("SELECT COUNT(*) as t FROM students")->fetch_assoc()['t'];
$total_franchise = $conn->query("SELECT COUNT(*) as t FROM franchise")->fetch_assoc()['t'];
$total_courses = $conn->query("SELECT COUNT(*) as t FROM courses")->fetch_assoc()['t'];
$total_university = $conn->query("SELECT COUNT(*) as t FROM universities")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard/dashboard.css">
</head>
<body>

<div class="sidebar">
  <h3><i class="fa-solid fa-user-shield"></i> Admin Panel</h3>
  <hr>

  <a class="active" href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a href="students.php"><i class="fa-solid fa-users"></i> Students</a>
  <a href="franchise_list.php"><i class="fa-solid fa-building"></i> Franchise</a>
  <a href="franchise_commission_report.php"><i class="fa-solid fa-coins"></i> Commission</a>
  <a href="enquiry_list.php"><i class="fa-solid fa-envelope"></i> Enquiries</a>
  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main-content">

  <div class="topbar">
    <h4>Koshi ERP Admin Dashboard</h4>
    <span class="profile-badge">ADMIN</span>
  </div>

  <div class="row g-4 mt-3">

    <div class="col-md-3">
      <div class="card-box text-center">
        <h5>Total Students</h5>
        <p class="big-number"><?php echo $total_students; ?></p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-box text-center">
        <h5>Total Franchise</h5>
        <p class="big-number"><?php echo $total_franchise; ?></p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-box text-center">
        <h5>Total Courses</h5>
        <p class="big-number"><?php echo $total_courses; ?></p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-box text-center">
        <h5>Total Universities</h5>
        <p class="big-number"><?php echo $total_university; ?></p>
      </div>
    </div>

  </div>

  <div class="row g-3 mt-4">

    <div class="col-md-3">
      <a href="students.php" class="btn btn-blue w-100 fw-bold p-3 rounded-4">
        <i class="fa-solid fa-users"></i> Manage Students
      </a>
    </div>

    <div class="col-md-3">
      <a href="franchise_list.php" class="btn btn-success w-100 fw-bold p-3 rounded-4">
        <i class="fa-solid fa-building"></i> Franchise Approvals
      </a>
    </div>

    <div class="col-md-3">
      <a href="franchise_commission_report.php" class="btn btn-warning w-100 fw-bold p-3 rounded-4">
        <i class="fa-solid fa-coins"></i> Commission Report
      </a>
    </div>

    <div class="col-md-3">
      <a href="../verify.php" class="btn btn-premium w-100 fw-bold p-3 rounded-4">
        <i class="fa-solid fa-qrcode"></i> Verification Portal
      </a>
    </div>

  </div>

</div>

</body>
</html>
