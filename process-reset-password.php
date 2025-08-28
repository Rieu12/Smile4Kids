<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Validate
    if ($password !== $confirm) {
        die("Passwords do not match.");
    }

    // Optional: Enforce strength again here
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password)) {
        die("Password must be at least 8 characters, contain a number and an uppercase letter.");
    }

    // Hash and update
    $hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE Users SET passwordHash = ? WHERE email = ?");
    $stmt->bind_param("ss", $hash, $email);

   if ($stmt->execute()) {
        header("Location: login.php?success=1");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
