
<?php
require_once 'includes/db_connect.php';

$success = '';
$errors = [];
$receiptData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_name = trim($_POST['donor_name']);
    $donor_email = trim($_POST['donor_email']);
    $amount = trim($_POST['amount']);

    if (empty($donor_name)) {
        $errors[] = "Name is required.";
    }

    if (!filter_var($donor_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (!is_numeric($amount) || $amount <= 0) {
        $errors[] = "Enter a valid donation amount.";
    }

    if (empty($errors)) {
        $reference = 'MPESA-' . strtoupper(substr(md5(uniqid()), 0, 10));
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_email, amount, reference) VALUES (?, ?, ?, ?)");
        $stmt->execute([$donor_name, $donor_email, $amount, $reference]);

        $receiptData = [
            'name' => $donor_name,
            'email' => $donor_email,
            'amount' => number_format($amount, 2),
            'reference' => $reference,
            'date' => date('Y-m-d H:i')
        ];
    }
}
?>

<?php include('includes/header.php'); ?>

<div class="form-container">
    <h2>Make a Donation</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($receiptData): ?>
        <div class="success-box">
            <h3>Payment Receipt</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($receiptData['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($receiptData['email']); ?></p>
            <p><strong>Amount:</strong> KES <?php echo $receiptData['amount']; ?></p>
            <p><strong>Reference:</strong> <?php echo $receiptData['reference']; ?></p>
            <p><strong>Date:</strong> <?php echo $receiptData['date']; ?></p>
        </div>
    <?php else: ?>
        <form method="POST" action="">
            <label for="donor_name">Full Name</label>
            <input type="text" id="donor_name" name="donor_name" required />

            <label for="donor_email">Email</label>
            <input type="email" id="donor_email" name="donor_email" required />

            <label for="amount">Amount (KES)</label>
            <input type="number" id="amount" name="amount" min="1" step="0.01" required />

            <button type="submit">Donate</button>
        </form>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
