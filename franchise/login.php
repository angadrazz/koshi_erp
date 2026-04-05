<?php
session_start();
include("../db.php");

$msg="";

if(isset($_POST['login'])){
  $fid = $_POST['franchise_id'];
  $pass = $_POST['password'];

  $res = $conn->query("SELECT * FROM franchise WHERE franchise_id='$fid' AND status='Approved'");

  if($res->num_rows > 0){
    $row = $res->fetch_assoc();

    if(password_verify($pass, $row['password'])){
      $_SESSION['franchise'] = $row['franchise_id'];
      header("Location: dashboard.php");
      exit();
    } else {
      $msg="Wrong Password!";
    }
  } else {
    $msg="Franchise Not Approved or Invalid ID!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Franchise Login</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:40px;}
    .box{max-width:450px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;color:red;font-weight:bold;margin-top:10px;}
  </style>
</head>
<body>

<div class="box">
  <h2>Franchise Login</h2>

  <?php if($msg!=""){ echo "<div class='msg'>$msg</div>"; } ?>

  <form method="POST">
    <input type="text" name="franchise_id" placeholder="Franchise ID" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
  </form>
</div>

</body>
</html>
