<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

// Fetch data safely
$res = $conn->query("SELECT * FROM franchise ORDER BY id DESC");
if(!$res){
  die("Query Failed: " . $conn->error);
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

<?php while($row = $res->fetch_assoc()) { ?>

<tr>
  <td><?= htmlspecialchars($row['franchise_id']) ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['mobile']) ?></td>
  <td><?= htmlspecialchars($row['email']) ?></td>
  <td><?= htmlspecialchars($row['city']) ?></td>
  <td><?= htmlspecialchars($row['district']) ?></td>
  <td><?= htmlspecialchars($row['state']) ?></td>
  <td><?= htmlspecialchars($row['commission_percent']) ?>%</td>
  <td><?= htmlspecialchars($row['status']) ?></td>

  <td>
    <a class="btn" href="franchise_status.php?id=<?= urlencode($row['id']) ?>&status=Approved">Approve</a>

    <a class="btn red" href="franchise_status.php?id=<?= urlencode($row['id']) ?>&status=Rejected">Reject</a>

    <a class="btn" href="generate_franchise_certificate.php?id=<?= urlencode($row['id']) ?>">
      Certificate
    </a>
  </td>
</tr>

<?php } ?>

</table>

</body>
</html>