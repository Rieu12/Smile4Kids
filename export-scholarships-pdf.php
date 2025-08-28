<?php
require 'db_connect.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

$html = "<h2>Scholarship Opportunities</h2>";

$query = "SELECT s.title, s.description, s.eligibility, s.deadline, u.fullName 
          FROM ScholarshipOpportunities s
          JOIN Users u ON s.userID = u.userID";

$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $html .= "<p><strong>Title:</strong> {$row['title']}<br>
              <strong>Eligibility:</strong> {$row['eligibility']}<br>
              <strong>Deadline:</strong> {$row['deadline']}<br>
              <em>Submitted by: {$row['fullName']}</em><br><hr></p>";
}

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("scholarship_opportunities.pdf");
?>
