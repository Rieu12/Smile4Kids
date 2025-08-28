<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['opportunityID'])) {
    $id = intval($_POST['opportunityID']);

    if (isset($_POST['approve'])) {
        // Add 'approved' column if needed
        $conn->query("ALTER TABLE scholarshipopportunities ADD COLUMN IF NOT EXISTS approved BOOLEAN DEFAULT FALSE");
        $stmt = $conn->prepare("UPDATE scholarshipopportunities SET approved = 1 WHERE opportunityID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "Opportunity approved.";
        // Example during verification

        $now = date("Y-m-d H:i:s");

        
    }

    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM scholarshipopportunities WHERE opportunityID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "Opportunity deleted.";
    }

    echo "<br><a href='manage-scholarships.php'>Go back</a>";
}
?>
