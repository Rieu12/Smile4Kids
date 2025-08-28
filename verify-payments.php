<?php
session_start();
require 'db_connect.php';

include('includes/header.php');

// Optional: protect admin access
// if ($_SESSION['role'] !== 'admin') { header("Location: dashboard.php"); exit; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unverified Payments</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: url('images/payments-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            overflow-y: auto;
        }

        h2 {
            font-size: 2.5rem;
            color: black;
            text-shadow: 0px 0px 6px rgba(0,0,0,0.8);
            margin-bottom: 20px;
        }

        .card-container {
            width: 100%;
            max-width: 800px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .payment-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.4);
        }

        .payment-card strong {
            color: #0073e6;
        }

        .payment-card p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #333;
        }

        .verify-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 18px;
            background: #0073e6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .verify-btn:hover {
            background: #005bb5;
            transform: scale(1.05);
        }

        .no-data {
            font-size: 1.3rem;
            color: white;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.7);
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }
            .payment-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

    <h2>Unverified Payments</h2>

    <div class="card-container">
        <?php
        $result = $conn->query("SELECT Payments.*, Users.fullName, Children.fullName AS childName
                                FROM Payments
                                JOIN Users ON Payments.userID = Users.userID
                                JOIN Children ON Payments.childID = Children.childID
                                WHERE verified = 0");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='payment-card'>
                        <p><strong>Donor:</strong> " . htmlspecialchars($row['fullName']) . "</p>
                        <p><strong>Child:</strong> " . htmlspecialchars($row['childName']) . "</p>
                        <p><strong>Method:</strong> " . htmlspecialchars($row['payment_method']) . "</p>
                        <p><strong>Transaction Code:</strong> " . htmlspecialchars($row['transaction_code']) . "</p>
                        <form method='POST' action='confirm-payment.php'>
                            <input type='hidden' name='paymentID' value='".htmlspecialchars($row['paymentID'])."'>
                            <button type='submit' class='verify-btn'>Verify Payment</button>
                        </form>
                      </div>";
            }
        } else {
            echo "<p class='no-data'>No pending payments.</p>";
        }

        $conn->close();
        ?>
    </div>

<?php include('includes/footer.php'); ?>

</body>
</html>
