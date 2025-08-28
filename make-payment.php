<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}
require 'db_connect.php';

if (!isset($_GET['childID'])) {
    die("No child selected.");
}

$childID = intval($_GET['childID']);
$stmt = $conn->prepare("SELECT * FROM Children WHERE childID = ?");
$stmt->bind_param("i", $childID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Child not found.");
}
$child = $result->fetch_assoc();
?>

<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make Payment - Smile4Kids</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: url('images/payment-bg.jpg') no-repeat center center fixed; /* ✅ Replace with your image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            width: 90%;
            max-width: 1800px;
            height: 90%;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            animation: fadeIn 0.8s ease;
        }

        h2 {
            text-align: center;
            font-size: 3rem;
            color: #0073e6;
            margin-bottom: 1.5rem;
        }

        h3 {
            font-size: 2.5rem;
            color: #0073e6;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .payment-instructions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .instruction-card {
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .instruction-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 1rem;
            font-size: 1.1rem;
        }

        input, select {
            width: 100%;
            padding: 12px;
            font-size: 1.5rem;
            border: 2px solid #ccc;
            border-radius: 6px;
            margin-top: 0.3rem;
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, select:focus {
            border: 2px solid #0073e6;
            box-shadow: 0 0 12px rgba(0, 115, 230, 0.3);
            outline: none;
        }

        button {
            margin-top: 2rem;
            width: 100%;
            padding: 14px;
            background: #0073e6;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #005bb5;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar */
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
            h2 {
                font-size: 2rem;
            }
            .container {
                padding: 1.5rem;
                width: 95%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Make a Payment for <?php echo htmlspecialchars($child['fullName']); ?></h2>

        <div class="info">
            <p><strong>Class:</strong> <?php echo htmlspecialchars($child['level_of_learning']); ?></p>
            <p><strong>Fees per Term:</strong> KES <?php echo number_format($child['annual_fees'], 2); ?></p>
        </div>

        <h3>Payment Instructions</h3>

        <div class="payment-instructions">
            <div class="instruction-card">
                <strong>1. Bank Transfer:</strong><br>
                Bank Name: SmileBank Ltd<br>
                Account Name: Smile4Kids Orphanage<br>
                Account Number: 0123456789<br>
                Branch Code: 11000<br>
                SWIFT Code: SMBKKE99<br>
                <em>Use the child's name as the payment reference.</em>
            </div>

            <div class="instruction-card">
                <strong>2. Paybill (Mobile Money - M-PESA):</strong><br>
                Paybill Number: 123456<br>
                Account Name: SMILE4KIDS#Name of child<br>
                <em>Enter the Child ID or Full Name as the Account Reference.</em>
            </div>

            <div class="instruction-card">
                <strong>3. PayPal:</strong><br>
                PayPal Email: donate@smile4kids.org<br>
                <em>Please include the child's full name in the payment note.</em>
            </div>
        </div>

        <form method="POST" action="submit-payment.php">
            <input type="hidden" name="childID" value="<?php echo $child['childID']; ?>">

            <label>Transaction Code (from your payment):</label>
            <input type="text" name="transaction_code" required>

            <label>Payment Method Used:</label>
            <select name="payment_method" required>
                <option value="bank">Bank Transfer</option>
                <option value="paybill">Paybill</option>
                <option value="paypal">PayPal</option>
            </select>

            <button type="submit">Submit Payment</button>
        </form>
    </div>

</body>
</html>

<?php include('includes/footer.php'); ?>
