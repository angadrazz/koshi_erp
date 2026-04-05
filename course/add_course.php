<?php
session_start();
include("../db.php");

if(!isset($_SESSION['coursemanager'])){
  header("Location: login.php");
  exit();
}

$msg="";

if(isset($_POST['save'])){

  $code = "CRS".date("Y").rand(1000,9999);

  $name = $_POST['course_name'];
  $cat = $_POST['category'];
  $duration = $_POST['duration'];
  $fees = $_POST['fees'];
  $elig = $_POST['eligibility'];
  $desc = $_POST['description'];

  $sql="INSERT INTO courses(course_code, course_name, category, duration, fees, eligibility, description, status)
        VALUES('$code','$name','$cat','$duration','$fees','$elig','$desc','Active')";

  if($conn->query($sql)===TRUE){
    $msg="Course Added Successfully! Code: ".$code;
  } else {
    $msg="Error: ".$conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Course</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:750px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select,textarea{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Add New Course</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST">
    <input type="text" name="course_name" placeholder="Course Name" required>

    <select name="category" required>
      <option value="">Select Category</option>
      <option>Computer</option>
      <option>Vocational</option>
      <option>Degree</option>
    </select>

    <input type="text" name="duration" placeholder="Duration (Example: 6 Months)" required>
    <input type="number" name="fees" placeholder="Fees Amount" required>
    <input type="text" name="eligibility" placeholder="Eligibility (Example: 10th Pass)" required>

    <textarea name="description" placeholder="Course Description / Syllabus"></textarea>

    <button type="submit" name="save">Save Course</button>
  </form>

  <a class="back" href="dashboard.php">⬅ Back Dashboard</a>
</div>

</body>
</html>
