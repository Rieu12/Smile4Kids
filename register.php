<?php include('includes/header.php'); ?>
<?php
session_start();
$errors = isset($_SESSION['form_errors']) ? $_SESSION['form_errors'] : [];
unset($_SESSION['form_errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Smile4Kids - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: url('images/register-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background: rgba(255,255,255,0.95);
            padding: 30px 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 1000px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
            animation: fadeIn 0.8s ease;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0073e6;
            font-size: 2rem;
        }
        .error-box {
            background: #ffe5e5;
            border: 1px solid #cc0000;
            color: #cc0000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .register-container label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            color: #333;
        }
        .register-container input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .register-container input:focus {
            border-color: #0073e6;
            box-shadow: 0 0 6px rgba(0, 115, 230, 0.4);
            outline: none;
        }
        .password-hint {
            font-size: 0.85rem;
            color: #555;
            margin-top: 3px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #0073e6;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background: #005bb5;
            transform: scale(1.03);
        }
        .login-link {
            text-align: center;
            margin-top: 12px;
            font-size: 0.95rem;
        }
        .login-link a {
            color: #0073e6;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Create Your Account</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="process-register.php">
        <label for="fullName">Full Name</label>
        <input type="text" id="fullName" name="fullName" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        <div class="password-hint">At least 8 characters, 1 uppercase, 1 number, and 1 special character.</div>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required />

        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Log in</a>
    </div>
</div>

</body>
</html>
<?php include('includes/footer.php'); ?>