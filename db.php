<?php
$conn = new mysqli("localhost", "root", "", "koshi_erp");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>