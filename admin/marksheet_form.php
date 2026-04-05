<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

$reg = $_GET['reg'];

$res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");
if($res->num_rows==0){
  die("Invalid Student!");
}
$student = $res->fetch_assoc();

$msg="";

$mres = $conn->query("SELECT * FROM marksheets WHERE reg_id='$reg'");
$marksheet = null;
if($mres->num_rows>0){
  $marksheet = $mres->fetch_assoc();
}

if(isset($_POST['save'])){

  $s1=$_POST['subject1']; $m1=$_POST['marks1'];
  $s2=$_POST['subject2']; $m2=$_POST['marks2'];
  $s3=$_POST['subject3']; $m3=$_POST['marks3'];
  $s4=$_POST['subject4']; $m4=$_POST['marks4'];
  $s5=$_POST['subject5']; $m5=$_POST['marks5'];

  $total_marks = 500;
  $obtained = $m1+$m2+$m3+$m4+$m5;

  $result_status = "Pass";
  if($obtained < 165){
    $result_status="Fail";
  }

  if($marksheet==null){
    $conn->query("INSERT INTO marksheets(reg_id,subject1,marks1,subject2,marks2,subject3,marks3,subject4,marks4,subject5,marks5,total_marks,obtained_marks,result_status)
    VALUES('$reg','$s1','$m1','$s2','$m2','$s3','$m3','$s4','$m4','$s5','$m5','$total_marks','$obtained','$result_status')");
  } else {
    $conn->query("UPDATE marksheets SET 
      subject1='$s1', marks1='$m1',
      subject2='$s2', marks2='$m2',
      subject3='$s3', marks3='$m3',
      subject4='$s4', marks4='$m4',
      subject5='$s5', marks5='$m5',
      total_marks='$total_marks',
      obtained_marks='$obtained',
      result_status='$result_status'
      WHERE reg_id='$reg'
    ");
  }

  $msg="Marksheet Saved Successfully!";
  header("Location: marksheet_form.php?reg=$reg&saved=1");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marksheet Generator</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard/dashboard.css">
</head>
<body>

<div class="sidebar">
  <h3><i class="fa-solid fa-user-shield"></i> Admin Panel</h3>
  <hr>
  <a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a class="active" href="students.php"><i class="fa-solid fa-users"></i> Students</a>
  <a href="logout.php" style="background:red;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="main-content">

  <div class="topbar">
    <h4>Marksheet Generator</h4>
    <span class="profile-badge"><?php echo $student['reg_id']; ?></span>
  </div>

  <div class="card-box mt-4">

    <h5><i class="fa-solid fa-book"></i> Student Marksheet Entry</h5>
    <p class="text-muted mb-0">
      <b>Name:</b> <?php echo $student['name']; ?> |
      <b>Course:</b> <?php echo $student['course_code']; ?>
    </p>

    <?php if(isset($_GET['saved'])){ ?>
      <div class="alert alert-success mt-3 fw-bold">✅ Marksheet Saved Successfully</div>
    <?php } ?>

    <form method="POST" class="mt-4">

      <div class="row g-3">
        <div class="col-md-8">
          <input class="form-control" type="text" name="subject1" placeholder="Subject 1"
          value="<?php echo $marksheet['subject1'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4">
          <input class="form-control" type="number" name="marks1" placeholder="Marks"
          value="<?php echo $marksheet['marks1'] ?? ''; ?>" required>
        </div>

        <div class="col-md-8">
          <input class="form-control" type="text" name="subject2" placeholder="Subject 2"
          value="<?php echo $marksheet['subject2'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4">
          <input class="form-control" type="number" name="marks2" placeholder="Marks"
          value="<?php echo $marksheet['marks2'] ?? ''; ?>" required>
        </div>

        <div class="col-md-8">
          <input class="form-control" type="text" name="subject3" placeholder="Subject 3"
          value="<?php echo $marksheet['subject3'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4">
          <input class="form-control" type="number" name="marks3" placeholder="Marks"
          value="<?php echo $marksheet['marks3'] ?? ''; ?>" required>
        </div>

        <div class="col-md-8">
          <input class="form-control" type="text" name="subject4" placeholder="Subject 4"
          value="<?php echo $marksheet['subject4'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4">
          <input class="form-control" type="number" name="marks4" placeholder="Marks"
          value="<?php echo $marksheet['marks4'] ?? ''; ?>" required>
        </div>

        <div class="col-md-8">
          <input class="form-control" type="text" name="subject5" placeholder="Subject 5"
          value="<?php echo $marksheet['subject5'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4">
          <input class="form-control" type="number" name="marks5" placeholder="Marks"
          value="<?php echo $marksheet['marks5'] ?? ''; ?>" required>
        </div>
      </div>

      <button class="btn btn-blue w-100 mt-4 fw-bold p-3">
        <i class="fa-solid fa-floppy-disk"></i> Save Marksheet
      </button>

    </form>

    <div class="mt-3 text-center">
      <a target="_blank" class="btn btn-premium fw-bold" href="../marksheet_pdf.php?reg=<?php echo $reg; ?>">
        <i class="fa-solid fa-file-pdf"></i> Download Marksheet PDF
      </a>
    </div>

  </div>

</div>

</body>
</html>
