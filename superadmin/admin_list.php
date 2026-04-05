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
  <title>Users List</title>
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

<h2>Admin / University / CourseManager List</h2>
<a class="back" href="dashboard.php">⬅ Back to Dashboard</a>

<table>
  <tr>
    <th>Name</th>
    <th>Username</th>
    <th>Role</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php
  $res = $conn->query("SELECT * FROM users WHERE role!='superadmin' ORDER BY id DESC");
  while($row = $res->fetch_assoc()){
    echo "<tr>
      <td>".$row['name']."</td>
      <td>".$row['username']."</td>
      <td>".$row['role']."</td>
      <td>".$row['email']."</td>
      <td>".$row['mobile']."</td>
      <td>".$row['status']."</td>
      <td>
        <a class='btn' href='user_status.php?id=".$row['id']."&status=Active'>Active</a>
        <a class='btn red' href='user_status.php?id=".$row['id']."&status=Inactive'>Inactive</a>
      </td>
    </tr>";
  }
  ?>

</table>

</body>
</html>
