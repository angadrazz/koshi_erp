<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];
$msg="";

$res = $conn->query("SELECT * FROM students WHERE id='$id'");
if($res->num_rows==0){
  die("Invalid Student");
}
$student = $res->fetch_assoc();

if(isset($_POST['save'])){

  $s1=$_POST['subject1']; $m1=$_POST['marks1'];
  $s2=$_POST['subject2']; $m2=$_POST['marks2'];
  $s3=$_POST['subject3']; $m3=$_POST['marks3'];
  $s4=$_POST['subject4']; $m4=$_POST['marks4'];
  $s5=$_POST['subject5']; $m5=$_POST['marks5'];

  $total=$_POST['total_marks'];
  $obtained=$m1+$m2+$m3+$m4+$m5;

  $result=$_POST['result_status'];

  $check = $conn->query("SELECT * FROM marksheets WHERE reg_id='".$student['reg_id']."'");
  if($check->num_rows>0){
    $conn->query("UPDATE marksheets SET 
      subject1='$s1', marks1='$m1',
      subject2='$s2', marks2='$m2',
      subject3='$s3', marks3='$m3',
      subject4='$s4', marks4='$m4',
      subject5='$s5', marks5='$m5',
      total_marks='$total',
      obtained_marks='$obtained',
      result_status='$result'
      WHERE reg_id='".$student['reg_id']."'
    ");
  } else {
    $conn->query("INSERT INTO marksheets(reg_id,subject1,marks1,subject2,marks2,subject3,marks3,subject4,marks4,subject5,marks5,total_marks,obtained_marks,result_status)
    VALUES('".$student['reg_id']."','$s1','$m1','$s2','$m2','$s3','$m3','$s4','$m4','$s5','$m5','$total','$obtained','$result')");
  }

  $msg="Marksheet Saved Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Subject Wise Marksheet</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:750px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
    a.pdf{display:inline-block;margin-top:15px;padding:10px 15px;background:purple;color:white;border-radius:10px;text-decoration:none;font-weight:bold;}
  </style>
</head>
<body>

<div class="box">
  <h2>Marksheet Generator (Subject Wise)</h2>

  <p><b>Student:</b> <?php echo $student['name']; ?> (<?php echo $student['reg_id']; ?>)</p>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST">

    <input type="text" name="subject1" placeholder="Subject 1 Name" required>
    <input type="number" name="marks1" placeholder="Marks 1" required>

    <input type="text" name="subject2" placeholder="Subject 2 Name" required>
    <input type="number" name="marks2" placeholder="Marks 2" required>

    <input type="text" name="subject3" placeholder="Subject 3 Name" required>
    <input type="number" name="marks3" placeholder="Marks 3" required>

    <input type="text" name="subject4" placeholder="Subject 4 Name" required>
    <input type="number" name="marks4" placeholder="Marks 4" required>

    <input type="text" name="subject5" placeholder="Subject 5 Name" required>
    <input type="number" name="marks5" placeholder="Marks 5" required>

    <input type="number" name="total_marks" placeholder="Total Marks (Example 500)" required>

    <select name="result_status" required>
      <option value="Pass">Pass</option>
      <option value="Fail">Fail</option>
    </select>

    <button type="submit" name="save">Save Marksheet</button>
  </form>

  <a class="pdf" target="_blank" href="../marksheet_pdf.php?reg=<?php echo $student['reg_id']; ?>">Download Marksheet PDF</a>

  <br><br>
  <a class="back" href="students.php">⬅ Back Students</a>
</div>

</body>
</html>
