<?php include('includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smile4Kids - New Password</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      background: url('images/new-password-bg.jpg') no-repeat center center fixed; /* ✅ Replace path */
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .password-container {
      background: rgba(255, 255, 255, 0.95);
      width: 75%;           /* ✅ Fill 3/4 page width */
      max-width: 900px;     /* Limit for very wide screens */
      padding: 3rem;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      animation: fadeIn 0.8s ease;
      text-align: center;
    }

    h2 {
      color: #0073e6;
      font-size: 2.5rem;
      margin-bottom: 2rem;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 1rem;
      font-size: 1.2rem;
      text-align: left;
    }

    input {
      width: 100%;
      padding: 14px;
      border-radius: 8px;
      border: 2px solid #ccc;
      font-size: 1.1rem;
      margin-top: 0.5rem;
      margin-bottom: 1.5rem;
      transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      border: 2px solid #0073e6;
      box-shadow: 0 0 12px rgba(0,115,230,0.3);
      outline: none;
    }

    button {
      width: 100%;
      padding: 16px;
      background: #0073e6;
      color: #fff;
      font-size: 1.2rem;
      border: 2px solid #005bb5;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background: #005bb5;
      border: 2px solid #004080;
      transform: translateY(-2px);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ✅ Responsive */
    @media (max-width: 768px) {
      .password-container {
        width: 90%;
        padding: 2rem;
      }
      h2 {
        font-size: 2rem;
      }
      input, button {
        font-size: 1rem;
        padding: 12px;
      }
    }
  </style>
</head>
<body>

  <div class="password-container">
    <h2>Set a New Password</h2>

    <form method="POST" action="process-reset-password.php">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">

      <label for="password">New Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm_password">Confirm New Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>

      <button type="submit">Reset Password</button>
    </form>
  </div>

</body>
</html>

<?php include('includes/footer.php'); ?>
