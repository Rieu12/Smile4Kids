<?php
session_start();
require 'db_connect.php';

echo "<h2>Scholarship Opportunities</h2>";

$query = "SELECT s.title, s.description, s.eligibility, s.deadline, u.fullName 
          FROM ScholarshipOpportunities s
          JOIN Users u ON s.userID = u.userID
          ORDER BY s.deadline ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; margin-bottom: 15px; padding: 10px;'>";
        echo "<strong>Title:</strong> " . htmlspecialchars($row['title']) . "<br>";
        echo "<strong>Eligibility:</strong> " . nl2br(htmlspecialchars($row['eligibility'])) . "<br>";
        echo "<strong>Deadline:</strong> " . htmlspecialchars($row['deadline']) . "<br>";
        echo "<strong>Description:</strong><br><pre>" . htmlspecialchars($row['description']) . "</pre>";
        echo "<em>Submitted by: " . htmlspecialchars($row['fullName']) . "</em>";
        echo "</div>";
    }
} else {
    echo "No scholarship opportunities submitted yet.";
}
?>
