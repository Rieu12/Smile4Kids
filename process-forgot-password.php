<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT userID FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Ideally send an email with a token, but here we redirect to a reset form
        header("Location: reset-password.php?email=" . urlencode($email));
        exit;
    } else {
        echo "Email not found.";
    }
}
?>
