<?php
session_start();
require_once 'db_connect.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Enter a valid email address.";
    }

    if (!preg_match('/^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/', $password)) {
        $errors[] = "Password must be at least 8 characters, include a number and a special character.";
    }

    if (!in_array($role, ['admin', 'user'])) {
        $errors[] = "Invalid user role selected.";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword, $role]);
        $success = "User successfully added.";
    }
}

include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('images/admin-add-user-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1;
        }

        .admin-dashboard {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            animation: fadeIn 0.8s ease-in-out;
        }

        .admin-dashboard h2 {
            text-align: center;
            font-size: 2rem;
            color: #0073e6;
            margin-bottom: 20px;
        }

        .error-box, .success-box {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .error-box {
            background: #ffe5e5;
            color: #cc0000;
            border: 1px solid #cc0000;
        }

        .success-box {
            background: #e6ffed;
            color: #1c7c32;
            border: 1px solid #1c7c32;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus, select:focus {
            border-color: #0073e6;
            box-shadow: 0 0 6px rgba(0,115,230,0.4);
            outline: none;
        }

        small {
            font-size: 0.9rem;
            color: #555;
            display: block;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
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
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        @media (max-width: 768px) {
            .admin-dashboard {
                padding: 20px;
            }
            .admin-dashboard h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="admin-dashboard">
        <h2>Add New User</h2>

        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php elseif ($success): ?>
            <div class="success-box"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
            <small>Password must be at least 8 characters and include a number and a special character.</small>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user">Helper</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Add User</button>
        </form>
    </div>

<?php include('includes/footer.php'); ?>
</body>
</html>
