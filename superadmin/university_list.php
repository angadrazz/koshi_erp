<?php
session_start();
include("../db.php");

if(!isset($_SESSION['superadmin'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>University List</title>
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

<h2>University List (All India)</h2>
<a class="back" href="dashboard.php">⬅ Back to Dashboard</a>

<table>
  <tr>
    <th>Code</th>
    <th>University Name</th>
    <th>Type</th>
    <th>State</th>
    <th>District</th>
    <th>Website</th>
    <th>Helpline</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php
  $res = $conn->query("SELECT * FROM universities ORDER BY id DESC");
  while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>".$row['uni_code']."</td>
      <td>".$row['university_name']."</td>
      <td>".$row['university_type']."</td>
      <td>".$row['state']."</td>
      <td>".$row['district']."</td>
      <td>".$row['website']."</td>
      <td>".$row['helpline']."</td>
      <td>".$row['status']."</td>
      <td>
        <a class='btn' href='university_status.php?id=".$row['id']."&status=Active'>Active</a>
        <a class='btn red' href='university_status.php?id=".$row['id']."&status=Inactive'>Inactive</a>
      </td>
    </tr>";
  }
  ?>

</table>

</body>
</html>
