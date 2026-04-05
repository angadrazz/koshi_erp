<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Students</title>
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

  <a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a class="active" href="students.php"><i class="fa-solid fa-users"></i> Students</a>
  <a href="franchise_list.php"><i class="fa-solid fa-building"></i> Franchise</a>
  <a href="franchise_commission_report.php"><i class="fa-solid fa-coins"></i> Commission</a>
  <a href="enquiry_list.php"><i class="fa-solid fa-envelope"></i> Enquiries</a>
  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main-content">

  <div class="topbar">
    <h4>Student Management</h4>
    <span class="profile-badge">ADMIN</span>
  </div>

  <div class="card-box mt-4">
    <h5 class="mb-3"><i class="fa-solid fa-users"></i> Students List</h5>

    <div class="table-responsive table-premium">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>Reg ID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Course</th>
            <th>University</th>
            <th>Admission</th>
            <th>Payment</th>
            <th>Fee Paid</th>
            <th>Certificate</th>
            <th>Receipt</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
<?php
$res = $conn->query("SELECT * FROM students ORDER BY id DESC");

if(!$res){
  die("Query Failed: " . $conn->error);
}

while($row = $res->fetch_assoc()){

  // Admission Status Badge
  $admissionBadge = "status-yellow";
  if($row['admission_status']=="Approved"){ $admissionBadge="status-green"; }
  if($row['admission_status']=="Rejected"){ $admissionBadge="status-red"; }

  // Payment Status Badge
  $paymentBadge = "status-yellow";
  if($row['payment_status']=="Paid"){ $paymentBadge="status-green"; }
?>
<tr>

  <td><?= htmlspecialchars($row['reg_id']) ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['mobile']) ?></td>
  <td><?= htmlspecialchars($row['course_code']) ?></td>
  <td><?= htmlspecialchars($row['university_code']) ?></td>

  <td>
    <span class="status-badge <?= $admissionBadge ?>">
      <?= htmlspecialchars($row['admission_status']) ?>
    </span>
  </td>

  <td>
    <span class="status-badge <?= $paymentBadge ?>">
      <?= htmlspecialchars($row['payment_status']) ?>
    </span>
  </td>

  <td><b>₹<?= htmlspecialchars($row['fee_paid']) ?></b></td>
  <td><?= htmlspecialchars($row['certificate_no']) ?></td>
  <td><?= htmlspecialchars($row['receipt_no']) ?></td>

  <td style="min-width:320px;">

    <a class="btn btn-sm btn-success fw-bold"
       href="approve_student.php?id=<?= urlencode($row['id']) ?>&status=Approved">
       Approve
    </a>

    <a class="btn btn-sm btn-danger fw-bold"
       href="approve_student.php?id=<?= urlencode($row['id']) ?>&status=Rejected">
       Reject
    </a>

    <!-- ✅ NEW FEE BUTTON -->
    <a class="btn btn-sm btn-warning fw-bold"
       href="update_fee.php?id=<?= urlencode($row['id']) ?>">
       Fee
    </a>

    <a class="btn btn-sm btn-primary fw-bold"
       href="marksheet_form.php?reg=<?= urlencode($row['reg_id']) ?>">
       Marksheet
    </a>

    <a class="btn btn-sm btn-dark fw-bold"
       href="generate_certificate.php?id=<?= urlencode($row['id']) ?>">
       Certificate
    </a>

    <a class="btn btn-sm btn-info fw-bold text-white"
       href="generate_idcard.php?reg=<?= urlencode($row['reg_id']) ?>">
       ID Card
    </a>

  </td>

</tr>
<?php } ?>
</tbody>

      </table>
    </div>

  </div>

</div>

</body>
</html>
