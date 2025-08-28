<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $level = $_POST['level'];
    $birthdate = $_POST['birthdate'];
    $academic = $_POST['academic_progress'];
    $fees = $_POST['fees'];
    $health = $_POST['health_status'];
    $disabled = isset($_POST['is_disabled']) ? intval($_POST['is_disabled']) : 0;
    $hobbies = $_POST['hobbies'];
    $background = $_POST['background'];

    // Handle image upload
    $imagePath = '';
    if (!empty($_FILES['child_image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['child_image']['name']);
        $targetImage = "uploads/images/" . $imageName;
        move_uploaded_file($_FILES['child_image']['tmp_name'], $targetImage);
        $imagePath = $imageName;
    }

    // Handle document upload
    $documentPath = '';
    if (!empty($_FILES['document_file']['name'])) {
        $docName = time() . "_" . basename($_FILES['document_file']['name']);
        $targetDoc = "uploads/documents/" . $docName;
        move_uploaded_file($_FILES['document_file']['tmp_name'], $targetDoc);
        $documentPath = $docName;
    }

    $stmt = $conn->prepare("INSERT INTO Children 
        (fullName, level_of_learning, birthdate, academic_progress, annual_fees, health_status, is_disabled, hobbies, background, image_path, document_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssdsdssss", 
        $fullName, 
        $level, 
        $birthdate, 
        $academic, 
        $fees, 
        $health, 
        $disabled, 
        $hobbies, 
        $background, 
        $imagePath, 
        $documentPath
    );

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
