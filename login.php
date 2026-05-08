<?php
session_start();
include("db.php");

$msg="";

if(isset($_POST['login'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  $res = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
  print_r($res);exit;
  if($res->num_rows > 0){

    $row = $res->fetch_assoc();
    $role = $row['role'];

    // store common session
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $role;

    // role wise redirect
    if($role=="admin"){
      $_SESSION['admin'] = $row['username'];
      header("Location: admin/dashboard.php");
      exit();
    }

    if($role=="university"){
      $_SESSION['university'] = $row['username'];
      header("Location: university/dashboard.php");
      exit();
    }

    if($role=="superadmin"){
      $_SESSION['superadmin'] = $row['username'];
      header("Location: superadmin/dashboard.php");
      exit();
    }

    if($role=="franchise"){
      $_SESSION['franchise_user'] = $row['username'];
      header("Location: franchise/dashboard.php");
      exit();
    }

    if($role=="course_manager"){
      $_SESSION['course_manager'] = $row['username'];
      header("Location: course_manager/dashboard.php");
      exit();
    }

    $msg="Invalid role assigned!";

  } else {
    $msg="Invalid Username or Password!";
  }
}else{
  print_r('No Post Method');exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>ERP Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="col-md-5 mx-auto bg-white p-4 shadow rounded">
    <h3 class="text-center fw-bold">ERP Login</h3>

    <?php if($msg!=""){ ?>
      <div class="alert alert-danger mt-3"><?php echo $msg; ?></div>
    <?php } ?>

    <form method="POST">
      <input type="text" name="username" class="form-control mt-3" placeholder="Username" required>
      <input type="password" name="password" class="form-control mt-3" placeholder="Password" required>

      <button name="login" class="btn btn-primary w-100 mt-4 fw-bold">Login</button>
    </form>
  </div>
</div>

</body>
</html>
