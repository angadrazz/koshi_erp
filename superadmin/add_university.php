<?php
session_start();
include("../db.php");

if(!isset($_SESSION['superadmin'])){
  header("Location: login.php");
  exit();
}

$msg="";

if(isset($_POST['save'])){

  $code = "UNI".date("Y").rand(1000,9999);

  $name = $_POST['university_name'];
  $type = $_POST['university_type'];
  $address = $_POST['address'];
  $state = $_POST['state'];
  $district = $_POST['district'];
  $website = $_POST['website'];
  $helpline = $_POST['helpline'];
  $email = $_POST['email'];

  $sql="INSERT INTO universities 
  (uni_code, university_name, university_type, address, state, district, website, helpline, email, status)
  VALUES
  ('$code','$name','$type','$address','$state','$district','$website','$helpline','$email','Active')";

  if($conn->query($sql)===TRUE){
    $msg="University Added Successfully! Code: ".$code;
  } else {
    $msg="Error: ".$conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add University</title>
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
  <h2>Add University (All India)</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST">
    <input type="text" name="university_name" placeholder="University Name" required>

    <select name="university_type" required>
      <option value="">Select University Type</option>
      <option>Government</option>
      <option>Private</option>
      <option>Deemed</option>
      <option>Open University</option>
    </select>

    <textarea name="address" placeholder="Full Address" required></textarea>
    <input type="text" name="state" placeholder="State" required>
    <input type="text" name="district" placeholder="District" required>

    <input type="text" name="website" placeholder="Website (optional)">
    <input type="text" name="helpline" placeholder="Helpline Number">
    <input type="email" name="email" placeholder="Official Email">

    <button type="submit" name="save">Save University</button>
  </form>

  <a class="back" href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
