<?php
session_start();
include("../db.php");

if(!isset($_SESSION['franchise'])){
  header("Location: login.php");
  exit();
}

$fid = $_SESSION['franchise'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Students</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:10px;border-bottom:1px solid #ddd;text-align:left;font-size:13px;}
    th{background:#0b5cff;color:white;}
    a.back{display:inline-block;margin-bottom:15px;padding:10px 15px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
  </style>
</head>
<body>

<h2>My Registered Students</h2>
<a class="back" href="dashboard.php">⬅ Back Dashboard</a>

<table>
<tr>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Mobile</th>
  <th>Course</th>
  <th>University</th>
  <th>Admission</th>
  <th>Payment</th>
  <th>Certificate</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM students WHERE franchise_id='$fid' ORDER BY id DESC");
while($row = $res->fetch_assoc()){
  echo "<tr>
    <td>".$row['reg_id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['mobile']."</td>
    <td>".$row['course_code']."</td>
    <td>".$row['university_code']."</td>
    <td>".$row['admission_status']."</td>
    <td>".$row['payment_status']."</td>
    <td>".$row['certificate_no']."</td>
  </tr>";
}
?>

</table>

</body>
</html>
