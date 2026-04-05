<?php
include("db.php");
include("config.php");

$reg = "";
$data = null;

if(isset($_GET['reg'])){
  $reg = $_GET['reg'];

  $res = $conn->query("SELECT * FROM students WHERE reg_id='$reg'");
  if($res->num_rows > 0){
    $data = $res->fetch_assoc();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Verification - Koshi Institute</title>
  <style>
    body{font-family:Arial;background:#f2f7ff;padding:30px;}
    .box{max-width:700px;margin:auto;background:white;padding:25px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.12);}
    h2{text-align:center;color:#0b5cff;}
    input{width:100%;padding:12px;border-radius:10px;border:1px solid #ccc;margin-top:10px;}
    button{width:100%;padding:12px;margin-top:12px;background:#0b5cff;color:white;font-weight:bold;border:none;border-radius:12px;}
    table{width:100%;margin-top:15px;border-collapse:collapse;}
    td{padding:10px;border-bottom:1px solid #ddd;}
    .status{font-weight:bold;padding:10px;border-radius:10px;text-align:center;margin-top:15px;}
    .valid{background:#d4edda;color:#155724;}
    .invalid{background:#f8d7da;color:#721c24;}
  </style>
</head>
<body>

<div class="box">
  <h2>Student Verification Portal</h2>

  <form method="GET">
    <input type="text" name="reg" placeholder="Enter Registration ID" value="<?php echo $reg; ?>" required>
    <button type="submit">Verify Student</button>
  </form>

  <?php if($reg!="" && $data==null){ ?>
    <div class="status invalid">❌ INVALID STUDENT / NOT FOUND</div>
  <?php } ?>

  <?php if($data!=null){ ?>
    <div class="status valid">✅ VERIFIED STUDENT RECORD FOUND</div>

    <table>
      <tr><td><b>Name</b></td><td><?php echo $data['name']; ?></td></tr>
      <tr><td><b>Father Name</b></td><td><?php echo $data['father_name']; ?></td></tr>
      <tr><td><b>Registration ID</b></td><td><?php echo $data['reg_id']; ?></td></tr>
      <tr><td><b>Student ID</b></td><td><?php echo $data['student_id']; ?></td></tr>
      <tr><td><b>Course Code</b></td><td><?php echo $data['course_code']; ?></td></tr>
      <tr><td><b>University Code</b></td><td><?php echo $data['university_code']; ?></td></tr>
      <tr><td><b>Admission Status</b></td><td><?php echo $data['admission_status']; ?></td></tr>
      <tr><td><b>Payment Status</b></td><td><?php echo $data['payment_status']; ?></td></tr>
      <tr><td><b>Course Status</b></td><td><?php echo $data['course_status']; ?></td></tr>
      <tr><td><b>Certificate No</b></td><td><?php echo $data['certificate_no']; ?></td></tr>
    </table>

    <br>

    <?php if($data['certificate_no']!=""){ ?>
      <a style="display:block;text-align:center;padding:12px;background:green;color:white;font-weight:bold;border-radius:12px;text-decoration:none;"
         target="_blank"
         href="certificate_pdf.php?reg=<?php echo $data['reg_id']; ?>">
         Download Certificate PDF
      </a>
    <?php } ?>

  <?php } ?>

</div>

</body>
</html>
