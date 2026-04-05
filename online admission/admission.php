<?php
include("../db.php");

$msg = "";

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $father = $_POST['father'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  $course = $_POST['course_code'];
  $university = $_POST['university_code'];

  $reg_id = "KOSHI".date("Y").rand(10000,99999);

  // PHOTO UPLOAD
  $photo_name = "";
  if(isset($_FILES['photo']) && $_FILES['photo']['name']!=""){
    $photo_name = time()."_".$_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/students/".$photo_name);
  }

  // DOCUMENT UPLOAD
  $doc_name = "";
  if(isset($_FILES['document']) && $_FILES['document']['name']!=""){
    $doc_name = time()."_".$_FILES['document']['name'];
    move_uploaded_file($_FILES['document']['tmp_name'], "uploads/documents/".$doc_name);
  }

  $sql = "INSERT INTO students
  (reg_id,name,father_name,mobile,email,address,photo,course_code,university_code,admission_status,payment_status,fee_paid)
  VALUES
  ('$reg_id','$name','$father','$mobile','$email','$address','$photo_name','$course','$university','Pending','Pending',0)";

  if($conn->query($sql)){
    $msg = "✅ Admission Submitted Successfully! Your Reg ID: <b>$reg_id</b>";
  } else {
    $msg = "❌ Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Admission - Koshi Institute</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body{
      background: linear-gradient(120deg,#001f4d,#0b5cff);
      font-family: Arial;
    }
    .form-box{
      max-width: 900px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 18px;
      box-shadow: 0px 15px 35px rgba(0,0,0,0.25);
    }
    .heading{
      text-align:center;
      font-weight:900;
      color:#001f4d;
      font-size:30px;
    }
    .sub{
      text-align:center;
      color:#444;
      margin-top:5px;
      font-weight:600;
    }
    .btn-premium{
      background: linear-gradient(90deg,#d4af37,#ffd700);
      border:none;
      padding:14px;
      border-radius:14px;
      font-weight:900;
      font-size:16px;
    }
    .btn-premium:hover{opacity:0.9;}
    .badge-line{
      text-align:center;
      margin-top:12px;
      font-weight:700;
      color:#0b5cff;
    }
    .form-control, .form-select{
      border-radius:14px;
      padding:12px;
      font-weight:600;
    }
  </style>
</head>

<body>

<div class="form-box">

  <div class="heading">
    <i class="fa-solid fa-graduation-cap"></i> Online Admission Form
  </div>

  <div class="sub">
    Koshi Institute of Higher Education (Koshi Shiksha Pvt Ltd)
  </div>

  <div class="badge-line">
    ISO 9001:2015 | MSME Registered | MCA Registered
  </div>

  <?php if($msg!=""){ ?>
    <div class="alert alert-success mt-4 fw-bold text-center">
      <?php echo $msg; ?>
    </div>
  <?php } ?>

  <form method="POST" enctype="multipart/form-data" class="mt-4">

    <div class="row g-3">

      <div class="col-md-6">
        <label class="fw-bold">Student Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter student name" required>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Father Name</label>
        <input type="text" name="father" class="form-control" placeholder="Enter father name" required>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Mobile Number</label>
        <input type="text" name="mobile" class="form-control" placeholder="Enter mobile number" required>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email (optional)">
      </div>

      <div class="col-md-12">
        <label class="fw-bold">Address</label>
        <textarea name="address" class="form-control" placeholder="Enter full address" required></textarea>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Select Course</label>
        <select name="course_code" class="form-select" required>
          <option value="">-- Select Course --</option>
          <option value="ADCA">ADCA</option>
          <option value="DCA">DCA</option>
          <option value="TALLY">TALLY PRIME</option>
          <option value="CCC">CCC</option>
          <option value="PGDCA">PGDCA</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Select University</label>
        <select name="university_code" class="form-select" required>
          <option value="">-- Select University --</option>
          <option value="UNI20260001">Koshi University Partner</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Upload Student Photo</label>
        <input type="file" name="photo" class="form-control" required>
      </div>

      <div class="col-md-6">
        <label class="fw-bold">Upload Document (Aadhar/Marksheet)</label>
        <input type="file" name="document" class="form-control">
      </div>

    </div>

    <button type="submit" name="submit" class="btn btn-premium w-100 mt-4">
      <i class="fa-solid fa-paper-plane"></i> Submit Admission Form
    </button>

  </form>

</div>

</body>
</html>
