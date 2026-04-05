<?php
session_start();
include("db.php");

$msg="";

if(isset($_POST['login'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  $res = $conn->query("SELECT * FROM users WHERE username='$username' AND status='Active'");

  if($res->num_rows > 0){

    $row = $res->fetch_assoc();

    if(password_verify($password, $row['password'])){

      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['role'] = $row['role'];

      if($row['role']=="superadmin"){
        header("Location: superadmin/dashboard.php");
      }
      elseif($row['role']=="admin"){
        header("Location: admin/dashboard.php");
      }
      elseif($row['role']=="university"){
        header("Location: university/dashboard.php");
      }
      elseif($row['role']=="coursemanager"){
        header("Location: course/dashboard.php");
      }
      else{
        $msg="Invalid Role!";
      }

      exit();

    } else {
      $msg="Wrong Password!";
    }

  } else {
    $msg="Invalid Username or Account Disabled!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>ERP Login - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:40px;}
    .box{max-width:450px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;cursor:pointer;}
    .msg{text-align:center;color:red;font-weight:bold;margin-top:10px;}
  </style>
</head>
<body>

<div class="box">
  <h2>ERP Main Login</h2>

  <?php if($msg!=""){ echo "<div class='msg'>$msg</div>"; } ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
  </form>
</div>

</body>
</html>
