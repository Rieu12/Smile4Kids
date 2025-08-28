<?php
session_start();
require 'db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT userID, fullName, passwordHash, role FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($userID, $fullName, $passwordHash, $role);
        $stmt->fetch();

        if (password_verify($password, $passwordHash)) {
            // Successful login
            $_SESSION['userID'] = $userID;
            $_SESSION['fullName'] = $fullName;
            $_SESSION['role'] = $role;

            if ($role === 'admin') {
            header("Location: admin_page_updated.php");
            } else {
            header("Location: dashboard.php");
            }
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
}

$_SESSION['login_error'] = $error;
header("Location: login.php");
exit;
?>
