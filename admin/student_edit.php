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
$row = $res->fetch_assoc();

$uni_list = $conn->query("SELECT * FROM universities WHERE status='Active'");
$course_list = $conn->query("SELECT * FROM courses WHERE status='Active'");

if(isset($_POST['save'])){
  $uni_code = $_POST['university_code'];
  $course_code = $_POST['course_code'];
  $payment = $_POST['payment_status'];

  $conn->query("UPDATE students 
  SET university_code='$uni_code', course_code='$course_code', payment_status='$payment'
  WHERE id='$id'");

  $msg="Updated Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Student</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:650px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    select{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Assign University & Course</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <p><b>Name:</b> <?php echo $row['name']; ?> (<?php echo $row['reg_id']; ?>)</p>

  <form method="POST">

    <select name="university_code" required>
      <option value="">Select University</option>
      <?php while($u = $uni_list->fetch_assoc()){ ?>
        <option value="<?php echo $u['uni_code']; ?>" <?php if($row['university_code']==$u['uni_code']) echo "selected"; ?>>
          <?php echo $u['university_name']." (".$u['uni_code'].")"; ?>
        </option>
      <?php } ?>
    </select>

    <select name="course_code" required>
      <option value="">Select Course</option>
      <?php while($c = $course_list->fetch_assoc()){ ?>
        <option value="<?php echo $c['course_code']; ?>" <?php if($row['course_code']==$c['course_code']) echo "selected"; ?>>
          <?php echo $c['course_name']." (".$c['course_code'].")"; ?>
        </option>
      <?php } ?>
    </select>

    <select name="payment_status" required>
      <option value="Pending" <?php if($row['payment_status']=="Pending") echo "selected"; ?>>Pending</option>
      <option value="Paid" <?php if($row['payment_status']=="Paid") echo "selected"; ?>>Paid</option>
    </select>

    <button type="submit" name="save">Save</button>
  </form>

  <a class="back" href="students.php">⬅ Back to Students</a>
</div>

</body>
</html>
