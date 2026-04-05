<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Franchise Requests</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:10px;border-bottom:1px solid #ddd;text-align:left;font-size:13px;}
    th{background:#0b5cff;color:white;}
    a.btn{padding:6px 10px;background:green;color:white;text-decoration:none;border-radius:8px;font-weight:bold;display:inline-block;margin:2px;}
    a.btn.red{background:red;}
    a.back{display:inline-block;margin-bottom:15px;padding:10px 15px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
  </style>
</head>
<body>

<h2>Franchise Requests</h2>
<a class="back" href="dashboard.php">⬅ Back Dashboard</a>

<table>
<tr>
  <th>Franchise ID</th>
  <th>Name</th>
  <th>Mobile</th>
  <th>Email</th>
  <th>City</th>
  <th>District</th>
  <th>State</th>
  <th>Commission</th>
  <th>Status</th>
  <th>Action</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM franchise ORDER BY id DESC");
while($row = $res->fetch_assoc()){

  echo "<tr>
    <td>".$row['franchise_id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['mobile']."</td>
    <td>".$row['email']."</td>
    <td>".$row['city']."</td>
    <td>".$row['district']."</td>
    <td>".$row['state']."</td>
    <td>".$row['commission_percent']."%</td>
    <td>".$row['status']."</td>

    <td>
      <a class='btn' href='franchise_status.php?id=".$row['id']."&status=Approved'>Approve</a>
      <a class='btn red' href='franchise_status.php?id=".$row['id']."&status=Rejected'>Reject</a>
    </td>
  </tr>";
}
?>

</table>

</body>
</html>
