<?php
include("../db.php");

$msg="";

if(isset($_POST['apply'])){

  $fid = "FRAN".date("Y").rand(1000,9999);

  $name=$_POST['name'];
  $mobile=$_POST['mobile'];
  $email=$_POST['email'];
  $city=$_POST['city'];
  $district=$_POST['district'];
  $state=$_POST['state'];
  $space=$_POST['space'];
  $investment=$_POST['investment'];
  $message=$_POST['message'];

  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql="INSERT INTO franchise(franchise_id,name,mobile,email,city,district,state,space,investment,message,password,status)
  VALUES('$fid','$name','$mobile','$email','$city','$district','$state','$space','$investment','$message','$pass','Pending')";

  if($conn->query($sql)===TRUE){
    $msg="Application Submitted! Your Franchise ID: ".$fid;
  } else {
    $msg="Error: ".$conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Franchise Registration</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:750px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,textarea{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:green;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Franchise Application Form</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST">
    <input type="text" name="name" placeholder="Full Name / Center Name" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="email" name="email" placeholder="Email (optional)">
    <input type="text" name="city" placeholder="City" required>
    <input type="text" name="district" placeholder="District" required>
    <input type="text" name="state" placeholder="State" required>

    <input type="text" name="space" placeholder="Space Available (Example: 500 Sqft)" required>
    <input type="text" name="investment" placeholder="Investment Capacity (Example: 1 Lakh)" required>

    <textarea name="message" placeholder="Message / Experience"></textarea>

    <input type="password" name="password" placeholder="Set Password" required>

    <button type="submit" name="apply">Submit Franchise Application</button>
  </form>
</div>

</body>
</html>
