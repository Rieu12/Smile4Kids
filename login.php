<?php include('includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smile4Kids - Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      background: url('images/login-bg.jpg') no-repeat center center fixed; /* ✅ Add your image */
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      width: 75%;         /* ✅ Fill 3/4 of page width */
      max-width: 900px;   /* Limit on very large screens */
      background: rgba(255, 255, 255, 0.95);
      padding: 3rem;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      animation: fadeIn 0.8s ease;
    }

    h2 {
      text-align: center;
      font-size: 2.5rem;
      color: #0073e6;
      margin-bottom: 2rem;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 0.3rem;
      font-size: 1.2rem;
    }

    input {
      width: 100%;
      padding: 14px;
      border-radius: 8px;
      border: 2px solid #ccc;
      font-size: 1.1rem;
      margin-bottom: 1.5rem;
      transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      border: 2px solid #0073e6;
      box-shadow: 0 0 12px rgba(0, 115, 230, 0.3);
      outline: none;
    }

    button {
      width: 100%;
      background: #0073e6;
      color: white;
      border: 2px solid #005bb5;
      padding: 16px;
      font-size: 1.2rem;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
      margin-bottom: 1rem;
    }

    button:hover {
      background: #005bb5;
      border: 2px solid #004080;
      transform: translateY(-2px);
    }

    .tooltip-text {
      background-color: #f44336;
      color: white;
      padding: 6px 10px;
      border-radius: 4px;
      position: absolute;
      left: 105%;
      top: 50%;
      transform: translateY(-50%);
      white-space: nowrap;
      z-index: 1;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      font-size: 0.9em;
      visibility: hidden;
    }

    .tooltip-text.visible {
      visibility: visible;
    }

    .error-tooltip {
      position: relative;
      display: block;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ✅ Responsive */
    @media (max-width: 768px) {
      .login-container {
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

  <div class="login-container">
    <h2>Login to Smile4Kids</h2>

    <form method="POST" action="process-login.php" onsubmit="return validateLoginForm()">
      <div class="error-tooltip">
        <label>Email:</label>
        <input type="email" id="email" name="email" required>
        <span class="tooltip-text" id="email-error"></span>
      </div>

      <div class="error-tooltip">
        <label>Password:</label>
        <input type="password" id="password" name="password" required>
        <span class="tooltip-text" id="password-error"></span>
      </div>

      <button type="submit">Login</button>
    </form>

    <form action="forgot_password.php" method="get">
      <button type="submit">Forgot Password?</button>
    </form>
  </div>

  <?php if (!empty($error)): ?>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const tooltip = document.getElementById('password-error');
        tooltip.textContent = <?php echo json_encode($error); ?>;
        tooltip.classList.add("visible");
      });
    </script>
  <?php endif; ?>

  <script>
    function validateLoginForm() {
      let valid = true;
      const email = document.getElementById("email");
      const password = document.getElementById("password");

      document.querySelectorAll('.tooltip-text').forEach(e => {
        e.textContent = "";
        e.classList.remove("visible");
      });

      if (!email.value.includes("@")) {
        document.getElementById("email-error").textContent = "Enter a valid email address.";
        document.getElementById("email-error").classList.add("visible");
        valid = false;
      }

      if (password.value.length < 8) {
        document.getElementById("password-error").textContent = "Password must be at least 8 characters.";
        document.getElementById("password-error").classList.add("visible");
        valid = false;
      }

      return valid;
    }
  </script>

</body>
</html>

<?php include('includes/footer.php'); ?>
