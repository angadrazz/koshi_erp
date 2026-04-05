<?php
session_start();
include("../db.php");

if(!isset($_SESSION['franchise'])){
  header("Location: login.php");
  exit();
}

$fid = $_SESSION['franchise'];
$msg="";

$course_list = $conn->query("SELECT * FROM courses WHERE status='Active'");
$uni_list = $conn->query("SELECT * FROM universities WHERE status='Active'");

if(isset($_POST['register'])){

  $reg_id = "KOSHI-REG-".date("Y").rand(1000,9999);

  $name=$_POST['name'];
  $father=$_POST['father_name'];
  $mobile=$_POST['mobile'];
  $email=$_POST['email'];
  $course=$_POST['course_code'];
  $university=$_POST['university_code'];
  $address=$_POST['address'];

  $photo_path="";
  if(!empty($_FILES['photo']['name'])){
    if(!is_dir("../uploads")){ mkdir("../uploads",0777,true); }
    $photo_name = $reg_id."_photo_".basename($_FILES['photo']['name']);
    $photo_path = "uploads/".$photo_name;
    move_uploaded_file($_FILES['photo']['tmp_name'], "../".$photo_path);
  }

  $conn->query("INSERT INTO students(reg_id, franchise_id, name, father_name, mobile, email, course_code, university_code, address, photo, admission_status, payment_status)
  VALUES('$reg_id','$fid','$name','$father','$mobile','$email','$course','$university','$address','$photo_path','Pending','Pending')");

  $msg="Student Registered Successfully! Reg ID: ".$reg_id;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register Student</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:750px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,textarea,select{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Franchise Student Registration</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Student Name" required>
    <input type="text" name="father_name" placeholder="Father Name" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="email" name="email" placeholder="Email (optional)">
    <textarea name="address" placeholder="Address" required></textarea>

    <select name="university_code" required>
      <option value="">Select University</option>
      <?php while($u=$uni_list->fetch_assoc()){ ?>
        <option value="<?php echo $u['uni_code']; ?>">
          <?php echo $u['university_name']." (".$u['uni_code'].")"; ?>
        </option>
      <?php } ?>
    </select>

    <select name="course_code" required>
      <option value="">Select Course</option>
      <?php while($c=$course_list->fetch_assoc()){ ?>
        <option value="<?php echo $c['course_code']; ?>">
          <?php echo $c['course_name']." (".$c['course_code'].")"; ?>
        </option>
      <?php } ?>
    </select>

    <input type="file" name="photo" required>

    <button type="submit" name="register">Register Student</button>
  </form>

  <a class="back" href="dashboard.php">⬅ Back Dashboard</a>
</div>

</body>
</html>
