<?php
include("db.php");
include("config.php");

$fid = "";
$data = null;

if(isset($_GET['fid'])){
  $fid = $_GET['fid'];

  $res = $conn->query("SELECT * FROM franchise WHERE franchise_id='$fid'");
  if($res->num_rows > 0){
    $data = $res->fetch_assoc();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Franchise Verification</title>
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
  <h2>Franchise Verification Portal</h2>

  <form method="GET">
    <input type="text" name="fid" placeholder="Enter Franchise ID" value="<?php echo $fid; ?>" required>
    <button type="submit">Verify Franchise</button>
  </form>

  <?php if($fid!="" && $data==null){ ?>
    <div class="status invalid">❌ INVALID FRANCHISE / NOT FOUND</div>
  <?php } ?>

  <?php if($data!=null){ ?>
    <div class="status valid">✅ VERIFIED FRANCHISE RECORD FOUND</div>

    <table>
      <tr><td><b>Franchise ID</b></td><td><?php echo $data['franchise_id']; ?></td></tr>
      <tr><td><b>Name / Center</b></td><td><?php echo $data['name']; ?></td></tr>
      <tr><td><b>Mobile</b></td><td><?php echo $data['mobile']; ?></td></tr>
      <tr><td><b>City</b></td><td><?php echo $data['city']; ?></td></tr>
      <tr><td><b>District</b></td><td><?php echo $data['district']; ?></td></tr>
      <tr><td><b>State</b></td><td><?php echo $data['state']; ?></td></tr>
      <tr><td><b>Status</b></td><td><?php echo $data['status']; ?></td></tr>
      <tr><td><b>Certificate No</b></td><td><?php echo $data['certificate_no']; ?></td></tr>
      <tr><td><b>Commission %</b></td><td><?php echo $data['commission_percent']; ?>%</td></tr>
    </table>

    <br>

    <?php if($data['certificate_no']!=""){ ?>
      <a style="display:block;text-align:center;padding:12px;background:green;color:white;font-weight:bold;border-radius:12px;text-decoration:none;"
         target="_blank"
         href="franchise_certificate_pdf.php?fid=<?php echo $data['franchise_id']; ?>">
         Download Franchise Certificate
      </a>
    <?php } ?>

  <?php } ?>

</div>

</body>
</html>
