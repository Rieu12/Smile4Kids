<?php
require 'db_connect.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=scholarship_opportunities.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['Title', 'Description', 'Eligibility', 'Deadline', 'Submitted By']);

$query = "SELECT s.title, s.description, s.eligibility, s.deadline, u.fullName 
          FROM ScholarshipOpportunities s
          JOIN Users u ON s.userID = u.userID";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
?>
