<?php
session_start();
require 'db_connect.php';

// Optional admin check
// if ($_SESSION['role'] !== 'admin') { header("Location: dashboard.php"); exit; }

echo "<h2>Manage Scholarship Opportunities</h2>";

$query = "SELECT s.*, u.fullName 
          FROM ScholarshipOpportunities s
          JOIN Users u ON s.userID = u.userID
          ORDER BY s.created_at DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
        echo "<strong>Title:</strong> " . htmlspecialchars($row['title']) . "<br>";
        echo "<strong>Description:</strong> " . nl2br(htmlspecialchars($row['description'])) . "<br>";
        echo "<strong>Eligibility:</strong> " . nl2br(htmlspecialchars($row['eligibility'])) . "<br>";
        echo "<strong>Deadline:</strong> " . $row['deadline'] . "<br>";
        echo "<em>Submitted by: " . htmlspecialchars($row['fullName']) . "</em><br>";

        // Admin-only buttons
        echo "<form method='POST' action='update-scholarship-status.php' style='display:inline;'>
                <input type='hidden' name='opportunityID' value='{$row['opportunityID']}'>
                <input type='submit' name='approve' value='Approve'>
              </form>
              <form method='POST' action='update-scholarship-status.php' style='display:inline;'>
                <input type='hidden' name='opportunityID' value='{$row['opportunityID']}'>
                <input type='submit' name='delete' value='Delete' onclick=\"return confirm('Are you sure?');\">
              </form>";
        echo "</div>";
    }
} else {
    echo "No scholarship opportunities found.";
}
?>
