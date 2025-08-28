<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}
?>

<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Scholarship Opportunity</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: url('images/scholarship-bg.jpg') no-repeat center center fixed; /* ✅ Replace with actual path */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            width: 90%;
            max-width: 600px;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.8s ease;
        }

        h2 {
            font-size: 2.5rem;
            color: #0073e6;
            margin-bottom: 2rem;
        }

        label {
            font-weight: bold;
            font-size: 1.2rem;
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
        }

        input[type="url"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 2px solid #ccc;
            border-radius: 6px;
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
            padding: 14px;
            font-size: 1.2rem;
            font-weight: bold;
            background: #0073e6;
            color: #fff;
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

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 1.5rem;
            }
            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Submit a Scholarship Opportunity</h2>
        <form method="POST" action="submit-scholarship.php" enctype="multipart/form-data">
            <label for="opportunity_link">Insert Opportunity Link:</label>
            <input type="url" name="opportunity_link" id="opportunity_link" placeholder="https://example.com/opportunity">

            <label for="opportunity_file">OR Upload PDF File:</label>
            <input type="file" name="opportunity_file" id="opportunity_file" accept="application/pdf">

            <button type="submit">Submit Opportunity</button>
        </form>
    </div>

</body>
</html>

<?php include('includes/footer.php'); ?>
