<?php
session_start();
require 'db_connect.php';

// Admin check
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Manage Children</title>
</head>
<body>
    <h2>Manage Child Records</h2>

    <?php
    $result = $conn->query("SELECT * FROM Children ORDER BY created_at DESC");

    if ($result->num_rows > 0) {
        while ($child = $result->fetch_assoc()) {
            echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px'>";
            echo "<strong>Name:</strong> " . htmlspecialchars($child['fullName']) . "<br>";
            echo "<strong>Level:</strong> " . htmlspecialchars($child['level_of_learning']) . "<br>";
            echo "<strong>Fees:</strong> KES " . number_format($child['annual_fees'], 2) . "<br>";
            echo "<strong>Health:</strong> " . htmlspecialchars($child['health_status']) . "<br>";
            echo "<strong>Disabled:</strong> " . ($child['is_disabled'] ? "Yes" : "No") . "<br>";
            echo "<strong>Hobbies:</strong> " . htmlspecialchars($child['hobbies']) . "<br>";
            echo "<strong>Background:</strong> " . htmlspecialchars($child['background']) . "<br>";

            echo "<a href='edit_child.php?id={$child['childID']}'>Edit</a> | 
                  <a href='delete_child.php?id={$child['childID']}' onclick=\"return confirm('Are you sure?');\">Delete</a>";
            echo "</div>";
        }
    } else {
        echo "No child records found.";
    }

    $conn->close();
    ?>
</body>
</html>
