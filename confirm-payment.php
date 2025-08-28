<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentID = intval($_POST['paymentID']);

    // ✅ Verify the payment
    $verify = $conn->prepare("UPDATE Payments 
                              SET verified = 1, verified_at = NOW(), verified_by = ? 
                              WHERE paymentID = ?");
    $verify->bind_param("ii", $_SESSION['userID'], $paymentID);
    $verify->execute();

    // ✅ Get childID from the payment
    $stmt = $conn->prepare("SELECT childID FROM Payments WHERE paymentID = ?");
    $stmt->bind_param("i", $paymentID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $childID = intval($row['childID']);

        // ✅ Mark the child as funded
        $updateChild = $conn->prepare("UPDATE Children SET is_funded = 1 WHERE childID = ?");
        $updateChild->bind_param("i", $childID);
        $updateChild->execute();
    }

    // ✅ Redirect back to verify-payments page
    header("Location: verify-payments.php?success=1");
    exit;
}
