<?php
session_start();
include("../db.php");

if(!isset($_SESSION['franchise'])){
  header("Location: login.php");
  exit();
}

$fid = $_SESSION['franchise'];

$fres = $conn->query("SELECT * FROM franchise WHERE franchise_id='$fid'");
$frow = $fres->fetch_assoc();

$total_students = $conn->query("SELECT COUNT(*) as t FROM students WHERE franchise_id='$fid'")->fetch_assoc()['t'];

$fee_res = $conn->query("SELECT SUM(fee_paid) as total_fee FROM students WHERE franchise_id='$fid'");
$fdata = $fee_res->fetch_assoc();
$total_fee = $fdata['total_fee'];
if($total_fee==""){ $total_fee=0; }

$percent = $frow['commission_percent'];
$commission = ($total_fee * $percent)/100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Franchise Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard/dashboard.css">
</head>
<body>

<div class="sidebar">
  <h3><i class="fa-solid fa-building"></i> Franchise Panel</h3>
  <hr>

  <a class="active" href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a href="add_student.php"><i class="fa-solid fa-user-plus"></i> Register Student</a>
  <a href="students.php"><i class="fa-solid fa-users"></i> My Students</a>

  <?php if($frow['certificate_no']!=""){ ?>
    <a target="_blank" href="../franchise_certificate_pdf.php?fid=<?php echo $fid; ?>">
      <i class="fa-solid fa-certificate"></i> Franchise Certificate
    </a>
  <?php } ?>

  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main-content">

  <div class="topbar">
    <h4><?php echo $frow['name']; ?></h4>
    <span class="profile-badge"><?php echo $fid; ?></span>
  </div>

  <div class="row g-4 mt-3">

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Total Students</h5>
        <p class="big-number"><?php echo $total_students; ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Total Fee Paid</h5>
        <p class="big-number">₹<?php echo $total_fee; ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Commission (<?php echo $percent; ?>%)</h5>
        <p class="big-number">₹<?php echo $commission; ?></p>
      </div>
    </div>

  </div>

</div>

</body>
</html>
