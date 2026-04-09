<?php
include("../db.php");

$msg="";

if(isset($_POST['apply'])){

  $fid = "FRAN".date("Y").rand(1000,9999);

  $name=$_POST['name'];
  $institute_reg_id=$_POST['institute_reg_id'];
  $mobile=$_POST['mobile'];
  $email=$_POST['email'];
  $city=$_POST['city'];
  $district=$_POST['district'];
  $state=$_POST['state'];
  $space=$_POST['space'];
  $investment=$_POST['investment'];
  $message=$_POST['message'];

  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // PDF Upload
  $pdf = $_FILES['pdf']['name'];
  $tmp = $_FILES['pdf']['tmp_name'];
  move_uploaded_file($tmp, "../uploads/".$pdf);

  $sql="INSERT INTO franchise(
  franchise_id,institute_reg_id,name,mobile,email,city,district,state,
  space,investment,message,password,pdf,status
  )
  VALUES(
  '$fid','$institute_reg_id','$name','$mobile','$email','$city','$district','$state',
  '$space','$investment','$message','$pass','$pdf','Pending'
  )";

  if($conn->query($sql)){
    $msg="🎉 Application Submitted! ID: ".$fid;
  } else {
    $msg="❌ Error: ".$conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Franchise Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
  background:#0f172a;
  font-family:'Poppins',sans-serif;
  color:white;
}

.main{
  display:flex;
  min-height:100vh;
}

/* LEFT SIDE */
.left{
  width:40%;
  background:linear-gradient(135deg,#00c6ff,#0072ff);
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding:20px;
}

.left h1{
  font-size:35px;
  font-weight:bold;
}

/* RIGHT SIDE */
.right{
  width:60%;
  padding:40px;
}

/* NEUMORPHIC INPUT */
.input-box{
  margin-bottom:15px;
}

.input-box input,
.input-box textarea{
  width:100%;
  padding:12px;
  border:none;
  border-radius:12px;
  background:#1e293b;
  color:white;
  box-shadow:inset 5px 5px 10px #0b1220,
             inset -5px -5px 10px #2a3a5a;
}

.input-box input:focus{
  outline:none;
  box-shadow:0 0 10px #00c6ff;
}

/* DRAG DROP */
.upload-box{
  border:2px dashed #00c6ff;
  padding:20px;
  text-align:center;
  border-radius:12px;
  cursor:pointer;
}

.upload-box:hover{
  background:#1e293b;
}

/* BUTTON */
.btn-submit{
  width:100%;
  padding:14px;
  border:none;
  border-radius:30px;
  background:linear-gradient(45deg,#00c6ff,#0072ff);
  font-weight:bold;
  color:white;
}

.msg{
  margin-bottom:10px;
  font-weight:bold;
}

</style>
</head>

<body>

<div class="main">

<!-- LEFT DESIGN -->
<div class="left">
  <div>
    <h1>Join Our Franchise</h1>
    <p>Grow your institute with us 🚀</p>
  </div>
</div>

<!-- RIGHT FORM -->
<div class="right">

<h3>Franchise Form</h3>

<?php if($msg!=""){ echo "<div class='msg'>$msg</div>"; } ?>

<form method="POST" enctype="multipart/form-data">

<div class="input-box">
<input type="text" name="name" placeholder="Full Name / Center Name" required>
</div>

<div class="input-box">
<input type="text" name="institute_reg_id" placeholder="Institute Registration ID" required>
</div>

<div class="input-box">
<input type="text" name="mobile" placeholder="Mobile Number" required>
</div>

<div class="input-box">
<input type="email" name="email" placeholder="Email">
</div>

<div class="row">
  <div class="col-md-4">
    <div class="input-box">
      <input type="text" name="city" placeholder="City">
    </div>
  </div>
  <div class="col-md-4">
    <div class="input-box">
      <input type="text" name="district" placeholder="District">
    </div>
  </div>
  <div class="col-md-4">
    <div class="input-box">
      <input type="text" name="state" placeholder="State">
    </div>
  </div>
</div>

<div class="input-box">
<input type="text" name="space" placeholder="Space Available">
</div>

<div class="input-box">
<input type="text" name="investment" placeholder="Investment Capacity">
</div>

<div class="input-box">
<textarea name="message" placeholder="Message"></textarea>
</div>

<div class="input-box">
<input type="password" name="password" placeholder="Password">
</div>

<!-- PDF Upload -->
<div class="upload-box" onclick="document.getElementById('pdf').click()">
  📄 Upload Institute Document (PDF)
  <input type="file" name="pdf" id="pdf" accept="application/pdf" hidden required>
</div>

<br>

<button type="submit" name="apply" class="btn-submit">
  🚀 Submit Application
</button>

</form>

</div>

</div>

</body>
</html>