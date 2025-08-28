<?php
session_start();
require 'db_connect.php';

$errors = [];

// === GET AND SANITIZE INPUTS ===
$fullName = trim($_POST['fullName'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

// === FULL NAME VALIDATION ===
if (empty($fullName)) {
    $errors[] = "Full name is required.";
} elseif (!preg_match("/^[a-zA-Z\s]{3,}$/", $fullName)) {
    $errors[] = "Full name must be at least 3 characters and contain only letters and spaces.";
}

// === EMAIL VALIDATION ===
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Enter a valid email address.";
}

// === PASSWORD VALIDATION ===
if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters.";
}
if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "Password must contain at least one uppercase letter.";
}
if (!preg_match('/[0-9]/', $password)) {
    $errors[] = "Password must include at least one number.";
}
if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
    $errors[] = "Password must include at least one special character.";
}
if ($password !== $confirm) {
    $errors[] = "Passwords do not match.";
}

// === IF ERRORS → SEND BACK ===
if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    header("Location: register.php");
    exit;
}

// === HASH PASSWORD ===
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// === INSERT INTO DATABASE ===
$stmt = $conn->prepare("INSERT INTO Users (fullName, email, passwordHash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fullName, $email, $hashedPassword);

if ($stmt->execute()) {
    header("Location: login.php?success=1");
    exit;
} else {
    $_SESSION['form_errors'] = ["Database error: " . $stmt->error];
    header("Location: register.php");
    exit;
}
