<?php
session_start();
include("../db.php");

if(!isset($_SESSION['superadmin'])){
  header("Location: login.php");
  exit();
}

$msg="";

if(isset($_POST['create'])){

  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $role = $_POST['role'];

  $default_pass = $_POST['password'];
  $hashed_pass = password_hash($default_pass, PASSWORD_DEFAULT);

  $sql="INSERT INTO users (name, username, email, mobile, password, role, status)
        VALUES ('$name','$username','$email','$mobile','$hashed_pass','$role','Active')";

  if($conn->query($sql)===TRUE){
    $msg="User Created Successfully! Username: $username | Password: $default_pass";
  } else {
    $msg="Error: ".$conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Admin/User</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:650px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
  </style>
</head>
<body>

<div class="box">
  <h2>Create Admin / University / Course Manager</h2>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="mobile" placeholder="Mobile">

    <select name="role" required>
      <option value="">Select Role</option>
      <option value="admin">Admin</option>
      <option value="university">University</option>
      <option value="coursemanager">Course Manager</option>
    </select>

    <input type="text" name="password" placeholder="Set Password" required>

    <button type="submit" name="create">Create User</button>
  </form>

  <a class="back" href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>
