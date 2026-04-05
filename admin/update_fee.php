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
if($res->num_rows==0){
  die("Invalid Student");
}
$row = $res->fetch_assoc();

if(isset($_POST['save'])){

  $fee = $_POST['fee_paid'];
  $pay_status = $_POST['payment_status'];

  if($row['receipt_no']==""){
    $receipt_no = "KOSHI-REC-".date("Y").rand(1000,9999);
    $receipt_date = date("d-m-Y");

    $conn->query("UPDATE students SET fee_paid='$fee', payment_status='$pay_status', receipt_no='$receipt_no', receipt_date='$receipt_date' WHERE id='$id'");
  } else {
    $conn->query("UPDATE students SET fee_paid='$fee', payment_status='$pay_status' WHERE id='$id'");
  }

  $msg="Fee Updated Successfully!";
  $res = $conn->query("SELECT * FROM students WHERE id='$id'");
  $row = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Student Fee</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:20px;}
    .box{max-width:650px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input,select{width:100%;padding:12px;margin-top:10px;border-radius:10px;border:1px solid #ccc;}
    button{width:100%;padding:12px;margin-top:15px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    .msg{text-align:center;font-weight:bold;margin-top:12px;color:green;}
    a.back{display:inline-block;margin-top:15px;text-decoration:none;font-weight:bold;color:green;}
    a.pdf{display:inline-block;margin-top:15px;padding:10px 15px;background:purple;color:white;border-radius:10px;text-decoration:none;font-weight:bold;}
  </style>
</head>
<body>

<div class="box">
  <h2>Update Fee Payment</h2>

  <p><b>Student:</b> <?php echo $row['name']; ?> (<?php echo $row['reg_id']; ?>)</p>
  <p><b>Receipt No:</b> <?php echo $row['receipt_no']; ?></p>

  <?php if($msg!=""){ echo "<p class='msg'>$msg</p>"; } ?>

  <form method="POST">
    <input type="number" name="fee_paid" placeholder="Enter Fee Paid Amount" value="<?php echo $row['fee_paid']; ?>" required>

    <select name="payment_status" required>
      <option value="Pending" <?php if($row['payment_status']=="Pending") echo "selected"; ?>>Pending</option>
      <option value="Paid" <?php if($row['payment_status']=="Paid") echo "selected"; ?>>Paid</option>
    </select>

    <button type="submit" name="save">Save Payment</button>
  </form>

  <?php if($row['receipt_no']!=""){ ?>
    <a class="pdf" target="_blank" href="../receipt_pdf.php?reg=<?php echo $row['reg_id']; ?>">Download Receipt PDF</a>
  <?php } ?>

  <br><br>
  <a class="back" href="students.php">⬅ Back Students</a>
</div>

</body>
</html>
