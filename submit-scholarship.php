<?php
session_start();
require 'db_connect.php';

$userID = $_SESSION['userID'];
$link = trim($_POST['opportunity_link'] ?? '');
$filePath = '';

// Handle PDF upload (if any)
if (!empty($_FILES['opportunity_file']['name'])) {
    $fileName = time() . "_" . basename($_FILES['opportunity_file']['name']);
    $targetPath = "uploads/scholarships/" . $fileName;

    if (move_uploaded_file($_FILES['opportunity_file']['tmp_name'], $targetPath)) {
        $filePath = $fileName;
    }
}

// Either link or file must be provided
if (empty($link) && empty($filePath)) {
    die("Please provide either a link or upload a PDF file.");
}

$stmt = $conn->prepare("INSERT INTO scholarshipopportunities (userID, link, document_path) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $userID, $link, $filePath);

if ($stmt->execute()) {
    header("Location: thank_you.html");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>
