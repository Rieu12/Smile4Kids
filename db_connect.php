<?php
$db_server = "localhost";
$db_user  = "root";
$db_pass = "";
$db_name = "smile4kids";
$charset = "utf8mb4";


$conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
$conn ->set_charset($charset);
?>
