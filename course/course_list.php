<?php
session_start();
include("../db.php");

if(!isset($_SESSION['coursemanager'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Course List</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left;font-size:14px;}
    th{background:#0b5cff;color:white;}
    a.btn{padding:6px 10px;background:green;color:white;text-decoration:none;border-radius:8px;font-weight:bold;}
    a.btn.red{background:red;}
    a.back{display:inline-block;margin-bottom:15px;padding:10px 15px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
  </style>
</head>
<body>

<h2>Course List</h2>
<a class="back" href="dashboard.php">⬅ Back Dashboard</a>

<table>
<tr>
  <th>Course Code</th>
  <th>Name</th>
  <th>Category</th>
  <th>Duration</th>
  <th>Fees</th>
  <th>Status</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM courses ORDER BY id DESC");
while($row = $res->fetch_assoc()){
  echo "<tr>
    <td>".$row['course_code']."</td>
    <td>".$row['course_name']."</td>
    <td>".$row['category']."</td>
    <td>".$row['duration']."</td>
    <td>₹".$row['fees']."</td>
    <td>".$row['status']."</td>
  </tr>";
}
?>

</table>
</body>
</html>
