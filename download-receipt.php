<?php
session_start();
require 'db_connect.php';
require 'includes/fpdf.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['userID'];

$stmt = $conn->prepare("SELECT p.*, c.fullName AS childName
                        FROM Payments p
                        JOIN Children c ON p.childID = c.childID
                        WHERE p.userID = ? AND p.verified = 1
                        ORDER BY p.payment_date DESC LIMIT 1");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_assoc();

// ✅ Prevent PDF attempt if no result
if (!$payment) {
    header("Location: dashboard.php?msg=No_verified_payment_found");
    exit;
}

// ✅ Build the PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Smile4Kids Donation Receipt', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Donor: ' . $_SESSION['fullName'], 0, 1);
$pdf->Cell(0, 10, 'Child Supported: ' . $payment['childName'], 0, 1);
$pdf->Cell(0, 10, 'Transaction Code: ' . $payment['transaction_code'], 0, 1);
$pdf->Cell(0, 10, 'Payment Method: ' . ucfirst($payment['payment_method']), 0, 1);
$pdf->Cell(0, 10, 'Payment Amount: ' . $payment['Payment_Amount'], 0, 1);
$pdf->Cell(0, 10, 'Date: ' . date("d M Y", strtotime($payment['payment_date'])), 0, 1);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Thank you for supporting Smile4Kids!', 0, 1, 'C');
// ✅ Ensure no whitespace or output before this
$pdf->Output('D', 'Smile4Kids_Receipt.pdf');
exit;
?>
