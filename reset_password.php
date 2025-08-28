<?php
session_start();
require_once 'includes/db_connect.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";
    } elseif (empty($newPassword) || empty($confirmPassword)) {
        $error = "Please fill in all password fields.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/', $newPassword)) {
        $error = "Password must be at least 8 characters long, include a number and a special character.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->execute([$hashedPassword, $user['id']]);
            $success = "Password has been reset successfully. You can now <a href='login.php'>log in</a>.";
        } else {
            $error = "No user found with that email address.";
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<div class="login-container">
    <h2>Reset Your Password</h2>

    <?php if ($error): ?>
        <div class="error-box"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="success-box"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" required />

        <label for="confirm_password">Confirm New Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required />

        <button type="submit">Reset Password</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
