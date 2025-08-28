
<?php include('includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
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
        .error-tooltip:hover .tooltip-text {
            visibility: visible;
        }
    </style>
</head>
<body>
    <h2>Login</h2>

    <form method="POST" action="process-login.php" onsubmit="return validateLoginForm()">
        <div class="error-tooltip">
            <label>Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <span class="tooltip-text" id="email-error"></span>
        </div><br>

        <div class="error-tooltip">
            <label>Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <span class="tooltip-text" id="password-error"></span>
        </div><br>

        <button type="submit">Login</button>
    </form>

    <?php if (!empty($error)): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const pwTooltip = document.getElementById('password-error');
            pwTooltip.textContent = <?php echo json_encode($error); ?>;
            pwTooltip.style.visibility = "visible";
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

    if (password.value === "") {
        document.getElementById("password-error").textContent = "Password is required.";
        document.getElementById("password-error").classList.add("visible");
        valid = false;
    }

    return valid;
}
    </script>
</body>
</html>
<?php include('includes/footer.php'); ?>
