<?php
session_start();
include("../db.php");

if(!isset($_SESSION['university'])){
  header("Location: login.php");
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
<html lang="en">
<head>
  <title>University Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard/dashboard.css">
</head>
<body>

<div class="sidebar">
  <h3><i class="fa-solid fa-university"></i> University Panel</h3>
  <hr>

  <a class="active" href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a href="students.php"><i class="fa-solid fa-users"></i> Students List</a>
  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main-content">

  <div class="topbar">
    <h4>University Dashboard</h4>
    <span class="profile-badge"><?php echo $uni_code; ?></span>
  </div>

  <div class="row g-4 mt-3">

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Total Students</h5>
        <p class="big-number"><?php echo $total; ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Running Students</h5>
        <p class="big-number"><?php echo $running; ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Completed Students</h5>
        <p class="big-number"><?php echo $completed; ?></p>
      </div>
    </div>

  </div>

</div>

</body>
</html>
