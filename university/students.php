<?php
session_start();
include("../db.php");

if(!isset($_SESSION['university'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>University Students</title>
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

<h2>University Student Records</h2>
<a class="back" href="dashboard.php">⬅ Back Dashboard</a>

<table>
<tr>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Course</th>
  <th>University</th>
  <th>Course Status</th>
  <th>Certificate</th>
  <th>Action</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM students ORDER BY id DESC");
while($row = $res->fetch_assoc()){

  echo "<tr>
    <td>".$row['reg_id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['course_code']."</td>
    <td>".$row['university_code']."</td>
    <td>".$row['course_status']."</td>
    <td>".$row['certificate_no']."</td>

    <td>
      <a class='btn' href='update_status.php?id=".$row['id']."&status=Completed'>Mark Completed</a>
      <a class='btn red' href='update_status.php?id=".$row['id']."&status=Running'>Mark Running</a>
    </td>
  </tr>";
}
?>

</table>

</body>
</html>
