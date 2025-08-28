<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userID'];
    $childID = intval($_POST['childID']);
    $method = trim($_POST['payment_method']);
    $transactionCode = trim($_POST['transaction_code']);

    // Validate method
    $validMethods = ['bank', 'paybill', 'paypal'];
    if (!in_array($method, $validMethods)) {
        die("Invalid payment method.");
    }

    // Validate transaction code
    if (strlen($transactionCode) < 5) {
        die("Transaction code must be at least 5 characters.");
    }

    // Save the payment
    $stmt = $conn->prepare("INSERT INTO Payments (userID, childID, transaction_code, payment_method) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $userID, $childID, $transactionCode, $method);

    if ($stmt->execute()) {
    header("Location: thank_you.html");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

    $stmt->close();
    $conn->close();
}
?>
