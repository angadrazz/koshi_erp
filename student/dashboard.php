<?php
session_start();
include("../db.php");

if(!isset($_SESSION['student_reg'])){
  header("Location: login.php");
  exit();
}

$reg = $_SESSION['student_reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");
if($res->num_rows==0){
  die("Student Not Found!");
}
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard/dashboard.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h3><i class="fa-solid fa-user-graduate"></i> Student Panel</h3>
  <hr>

  <a class="active" href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a href="../verify.php?reg=<?php echo $row['reg_id']; ?>"><i class="fa-solid fa-qrcode"></i> Verify Record</a>
  <a href="../pay_now.php?reg=<?php echo $row['reg_id']; ?>"><i class="fa-solid fa-credit-card"></i> Pay Online</a>
  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<!-- MAIN -->
<div class="main-content">

  <div class="topbar">
    <h4>Welcome, <?php echo $row['name']; ?></h4>
    <span class="profile-badge"><?php echo $row['reg_id']; ?></span>
  </div>

  <div class="row g-4 mt-3">

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Admission Status</h5>
        <p class="big-number"><?php echo $row['admission_status']; ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Payment Status</h5>
        <p class="big-number"><?php echo $row['payment_status']; ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box text-center">
        <h5>Fee Paid</h5>
        <p class="big-number">₹<?php echo $row['fee_paid']; ?></p>
      </div>
    </div>

  </div>

  <div class="card-box mt-4">
    <h5>Student Profile</h5>

    <table class="table table-bordered mt-3">
      <tr><th>Registration ID</th><td><?php echo $row['reg_id']; ?></td></tr>
      <tr><th>Name</th><td><?php echo $row['name']; ?></td></tr>
      <tr><th>Father Name</th><td><?php echo $row['father_name']; ?></td></tr>
      <tr><th>Mobile</th><td><?php echo $row['mobile']; ?></td></tr>
      <tr><th>Email</th><td><?php echo $row['email']; ?></td></tr>
      <tr><th>Course</th><td><?php echo $row['course_code']; ?></td></tr>
      <tr><th>University</th><td><?php echo $row['university_code']; ?></td></tr>
      <tr><th>Certificate No</th><td><?php echo $row['certificate_no']; ?></td></tr>
      <tr><th>Receipt No</th><td><?php echo $row['receipt_no']; ?></td></tr>
    </table>

    <div class="mt-3">

      <?php if($row['receipt_no']!=""){ ?>
        <a target="_blank" class="btn btn-blue" href="../receipt_pdf.php?reg=<?php echo $row['reg_id']; ?>">
          <i class="fa-solid fa-file-pdf"></i> Receipt PDF
        </a>
      <?php } ?>

      <?php if($row['certificate_no']!=""){ ?>
        <a target="_blank" class="btn btn-success fw-bold" href="../certificate_pdf.php?reg=<?php echo $row['reg_id']; ?>">
          <i class="fa-solid fa-award"></i> Certificate PDF
        </a>
      <?php } ?>

      <a target="_blank" class="btn btn-warning fw-bold" href="../marksheet_pdf.php?reg=<?php echo $row['reg_id']; ?>">
        <i class="fa-solid fa-book"></i> Marksheet PDF
      </a>

      <?php if($row['idcard_status']=="Generated"){ ?>
        <a target="_blank" class="btn btn-premium" href="../idcard_pdf.php?reg=<?php echo $row['reg_id']; ?>">
          <i class="fa-solid fa-id-card"></i> ID Card PDF
        </a>
      <?php } ?>

    </div>

  </div>

</div>

</body>
</html>
