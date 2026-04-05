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
  <title>Franchise Commission Report</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    h2{color:#0b5cff;text-align:center;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:12px;overflow:hidden;}
    th,td{padding:10px;border-bottom:1px solid #ddd;text-align:left;font-size:13px;}
    th{background:#0b5cff;color:white;}
    .back{display:inline-block;margin-bottom:15px;padding:10px 15px;background:green;color:white;text-decoration:none;border-radius:10px;font-weight:bold;}
  </style>
</head>
<body>

<h2>Franchise Commission Report</h2>
<a class="back" href="dashboard.php">⬅ Back Dashboard</a>

<table>
<tr>
  <th>Franchise ID</th>
  <th>Name</th>
  <th>Commission %</th>
  <th>Total Students</th>
  <th>Total Fee Paid</th>
  <th>Total Commission</th>
</tr>

<?php
$fres = $conn->query("SELECT * FROM franchise WHERE status='Approved' ORDER BY id DESC");
while($f = $fres->fetch_assoc()){

  $fid = $f['franchise_id'];
  $percent = $f['commission_percent'];

  $sres = $conn->query("SELECT COUNT(*) as total_students, SUM(fee_paid) as total_fee 
                        FROM students WHERE franchise_id='$fid'");

  $sdata = $sres->fetch_assoc();

  $total_students = $sdata['total_students'];
  $total_fee = $sdata['total_fee'];

  if($total_fee==""){ $total_fee=0; }

  $commission = ($total_fee * $percent)/100;

  echo "<tr>
    <td>$fid</td>
    <td>".$f['name']."</td>
    <td>".$percent."%</td>
    <td>".$total_students."</td>
    <td>₹".$total_fee."</td>
    <td><b>₹".$commission."</b></td>
  </tr>";
}
?>

</table>

</body>
</html>
