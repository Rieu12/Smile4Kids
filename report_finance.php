<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="style.css">

<?php
session_start();
require 'db_connect.php';

echo "<h2>Report Finance</h2>";

$result = $conn->query("SELECT payment_method, COUNT(*) as total_transactions, MAX(payment_date) as latest FROM Payments GROUP BY payment_method");

if ($result && $result->num_rows > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    $firstRow = true;
    while ($row = $result->fetch_assoc()) {
        if ($firstRow) {
            echo "<tr>";
            foreach ($row as $col => $val) {
                echo "<th>" . htmlspecialchars($col) . "</th>";
            }
            echo "</tr>";
            $firstRow = false;
        }
        echo "<tr>";
        foreach ($row as $val) {
            echo "<td>" . htmlspecialchars($val) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}
$conn->close();
?>
<?php include('includes/footer.php'); ?>
