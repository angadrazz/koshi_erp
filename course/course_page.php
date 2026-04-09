<?php
$conn = new mysqli("localhost", "root", "", "koshi_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['cat']) ? $_GET['cat'] : 'Computer';

$sql = "SELECT * FROM courses WHERE category='$category' AND status='active'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $category; ?> Courses</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f5f7fa;
}
.header {
    text-align: center;
    padding: 40px 0;
}
.course-card {
    border-radius: 15px;
    transition: 0.3s;
}
.course-card:hover {
    transform: translateY(-8px);
}
.btn-custom {
    border-radius: 25px;
}
</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h2><?php echo $category; ?> Courses</h2>
        <p>Explore professional programs with certification</p>
    </div>

    <div class="row">

    <?php if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { ?>

        <div class="col-md-4 mb-4">
            <div class="card course-card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['course_name']; ?></h5>
                    <p><strong>Duration:</strong> <?php echo $row['duration']; ?></p>
                    <p><strong>Fees:</strong> ₹<?php echo $row['fees']; ?></p>
                    <p><strong>Eligibility:</strong> <?php echo $row['eligibility']; ?></p>

                    <button class="btn btn-primary btn-custom w-100" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id']; ?>">
                        View Details
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="modal<?php echo $row['id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo $row['course_name']; ?></h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $row['description']; ?></p>
                        <p><b>Duration:</b> <?php echo $row['duration']; ?></p>
                        <p><b>Fees:</b> ₹<?php echo $row['fees']; ?></p>
                        <p><b>Eligibility:</b> <?php echo $row['eligibility']; ?></p>
                    </div>
                    <div class="modal-footer">
                        <a href="admission.php?course_id=<?php echo $row['id']; ?>" class="btn btn-success">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php } } else { ?>

        <div class="text-center">
            <h4>No courses found</h4>
        </div>

    <?php } ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>