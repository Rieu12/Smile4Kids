<?php
session_start();
require 'db_connect.php';

// Ensure the request is POST and required fields are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['childID'])) {
    $childID = intval($_POST['childID']);
    $fullName = trim($_POST['fullName'] ?? '');
    $level = $_POST['level'] ?? '';
    $academic_progress = $_POST['academic_progress'] ?? '';
    $fees = floatval($_POST['fees'] ?? 0);
    $health_status = $_POST['health_status'] ?? '';
    $is_disabled = isset($_POST['is_disabled']) ? intval($_POST['is_disabled']) : 0;
    $hobbies = $_POST['hobbies'] ?? '';
    $background = $_POST['background'] ?? '';

    // Optional: Validate values here (e.g. fees > 0, name not empty, etc.)

    $stmt = $conn->prepare("UPDATE Children 
                            SET fullName = ?, 
                                level_of_learning = ?, 
                                academic_progress = ?, 
                                annual_fees = ?, 
                                health_status = ?, 
                                is_disabled = ?, 
                                hobbies = ?, 
                                background = ? 
                                is_funded=0
                            WHERE childID = ?");
    $stmt->bind_param(
        "ssssdsdsi",
        $fullName,
        $level,
        $academic_progress,
        $fees,
        $health_status,
        $is_disabled,
        $hobbies,
        $background,
        $childID
    );

    if ($stmt->execute()) {
        header("Location: edit-select-child.php?success=1");
        exit;
    } else {
        echo "Error updating child: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
