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
  <title>Admission Enquiries</title>
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
  <a class="active" href="enquiry_list.php"><i class="fa-solid fa-envelope"></i> Enquiries</a>
  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main-content">

  <div class="topbar">
    <h4>Admission Enquiries</h4>
    <span class="profile-badge">ADMIN</span>
  </div>

  <div class="table-premium mt-4">
    <table class="table table-bordered mb-0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Course</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $res = $conn->query("SELECT * FROM enquiries ORDER BY id DESC");
        while($row = $res->fetch_assoc()){
          echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['mobile']."</td>
            <td>".$row['email']."</td>
            <td>".$row['course_interest']."</td>
            <td>".$row['message']."</td>
            <td>".$row['created_at']."</td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>
