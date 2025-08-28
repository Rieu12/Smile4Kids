<?php include('includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smile4Kids - Reset Password</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      background: url('images/reset-bg.jpg') no-repeat center center fixed; /* ✅ Replace with your image */
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .reset-container {
      background: rgba(255, 255, 255, 0.95);
      width: 75%;           /* ✅ Fill 3/4 of page width */
      max-width: 900px;     /* Avoid too large on wide screens */
      padding: 3rem;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      text-align: center;
      animation: fadeIn 0.8s ease;
    }

    h2 {
      color: #0073e6;
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
    }

    label {
      font-weight: bold;
      font-size: 1.2rem;
      display: block;
      margin-bottom: 0.5rem;
    }

    input {
      width: 100%;
      padding: 14px;
      font-size: 1.1rem;
      border-radius: 8px;
      border: 2px solid #ccc;
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
      .reset-container {
        width: 90%;
        padding: 2rem;
      }
      h2 {
        font-size: 2rem;
      }
      label {
        font-size: 1rem;
      }
      input, button {
        font-size: 1rem;
        padding: 12px;
      }
    }
  </style>
</head>
<body>

  <div class="reset-container">
    <h2>Reset Your Password</h2>
    <form method="POST" action="process-forgot-password.php">
      <label for="email">Enter your registered email:</label>
      <input type="email" id="email" name="email" required>
      <button type="submit">Send Reset Link</button>
    </form>
  </div>

</body>
</html>

<?php include('includes/footer.php'); ?>
