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
    <title>Smile4Kids - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100vh; /* Use full height */
    margin: 0;
    background: url('images/dashboard-bg.jpg') no-repeat center center fixed;
    background-size: cover;

    display: flex;
    justify-content: center;  /* Horizontal center */
    align-items: center;      /* Vertical center */
}

        .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            width: 60%;
            height: 60%;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #0073e6;
            margin-bottom: 2rem;
        }

        .dashboard {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-auto-rows: 1fr;
            gap: 1.5rem;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .card h3 {
            font-size: 1.8rem;
            color: #0073e6;
            margin-bottom: 1rem;
        }

        .card p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 1.5rem;
        }

        .card a {
            display: inline-block;
            text-decoration: none;
            background: #0073e6;
            color: white;
            padding: 14px 22px;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .card a:hover {
            background: #005bb5;
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }
            .card h3 {
                font-size: 1.5rem;
            }
            .card p {
                font-size: 1rem;
            }
        }
        .logout-container {
    position: absolute;
    top: 20px;
    right: 20px;
        }

        .logout-btn {
            background: #cc0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #a00000;
}
    </style>
</head>
<body>
    <div class="logout-container">
    <form method="POST" action="logout.php">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['fullName']); ?>!</h2>

        <div class="dashboard">
            <div class="card">
                <h3>My Contributions</h3>
                <p>View your donation history</p>
                <a href="contributions.php">View Contributions</a>
            </div>

            <div class="card">
                <h3>Receipts</h3>
                <p>Download your latest receipt</p>
                <a href="download-receipt.php">Download Receipt</a>
            </div>

            <div class="card">
                <h3>Make a Donation</h3>
                <p>Support a child’s education</p>
                <a href="child-list.php">Donate Now</a>
            </div>

            <div class="card">
                <h3>Scholarship</h3>
                <p>Submit a scholarship opportunity</p>
                <a href="scholarship-form.php">Submit</a>
            </div>
        </div>
    </div>

</body>
</html>

<?php include('includes/footer.php'); ?>
