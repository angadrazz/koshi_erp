<?php
include("db.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$course_interest = $_POST['course_interest'];
$message = $_POST['message'];

$conn->query("INSERT INTO enquiries(name,mobile,email,course_interest,message)
VALUES('$name','$mobile','$email','$course_interest','$message')");

header("Location: index.php?success=1");
exit();
?>
