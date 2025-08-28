<?php
require_once 'includes/db_connect.php';

$email = 'admin@smile4kids.org';
$username = 'admin';
$password = 'Admin@123'; // Plain text input
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
$stmt->execute([$username, $email, $hashed]);

echo "Admin user created.";
