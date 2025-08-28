<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['userID'];
?>

<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Contributions - Smile4Kids</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: url('images/contributions-bg.jpg') no-repeat center center fixed; /* ✅ Replace with your image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            width: 75%;
            max-width: 1000px;
            height: 90%;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            animation: fadeIn 0.8s ease;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #0073e6;
            margin-bottom: 2rem;
        }

        .contribution-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contribution-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .contribution-card strong {
            color: #0073e6;
        }

        .no-data {
            text-align: center;
            font-size: 1.3rem;
            color: #444;
            margin-top: 3rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ✅ Scrollbar Styling */
        .container::-webkit-scrollbar {
            width: 8px;
        }
        .container::-webkit-scrollbar-track {
            background: #ddd;
        }
        .container::-webkit-scrollbar-thumb {
            background: #0073e6;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 1.5rem;
            }
            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>My Contributions</h2>

        <?php
       $stmt = $conn->prepare("
            SELECT 
                p.paymentID, 
                c.fullName AS childName, 
                c.annual_fees AS paymentAmount,  -- ✅ Get amount automatically
                p.payment_method, 
                p.transaction_code, 
                p.payment_date, 
                p.verified
            FROM Payments p
            JOIN Children c ON p.childID = c.childID
            WHERE p.userID = ?
            ORDER BY p.payment_date DESC
        ");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='contribution-card'>";
                echo "<p><strong>Child:</strong> " . htmlspecialchars($row['childName']) . "</p>";
                echo "<p><strong>Amount:</strong> KES " . htmlspecialchars($row['paymentAmount']) . "</p>";
                echo "<p><strong>Method:</strong> " . htmlspecialchars($row['payment_method']) . "</p>";
                echo "<p><strong>Transaction Code:</strong> " . htmlspecialchars($row['transaction_code']) . "</p>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($row['payment_date']) . "</p>";
                echo "<p><strong>Status:</strong> " . ($row['verified'] ? "Verified" : "Pending") . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-data'>You have not made any payments yet.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

</body>
</html>

<?php include('includes/footer.php'); ?>
