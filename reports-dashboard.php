<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Reports Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: url('images/reports-bg.jpg') no-repeat center center fixed; /* ✅ Replace with your image */
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        /* ✅ Top Navigation */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 115, 230, 0.95);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .top-nav h1 {
            font-size: 1.8rem;
        }

        .top-nav a.logout-btn {
            background: #cc0000;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .top-nav a.logout-btn:hover {
            background: #a00000;
            transform: scale(1.05);
        }

        /* ✅ Container */
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 120px; /* Avoid nav overlap */
            padding-bottom: 40px;
        }

        .report-grid {
            background: rgba(255, 255, 255, 0.95);
            width: 90%;
            max-width: 1800px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 2fr));
            gap: 3rem;
            animation: fadeIn 0.8s ease;
        }

        .report-card {
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            border-left: 6px solid #4CAF50;
        }

        .report-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .report-card h3 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .report-card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

        .report-card a {
            display: inline-block;
            padding: 10px 16px;
            background: #4CAF50;
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .report-card a:hover {
            background: #388e3c;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .top-nav h1 {
                font-size: 1.4rem;
            }
            .report-card h3 {
                font-size: 1.1rem;
            }
            .report-card p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- ✅ Top Navigation -->
    <div class="top-nav">
        <h1>Reports Dashboard</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- ✅ Main Content -->
    <div class="container">
        <div class="report-grid">
            <div class="report-card">
                <h3>Donation Report</h3>
                <p>Track all donor transactions and payment statuses.</p>
                <a href="report_donations.php">View Report</a>
            </div>

            <div class="report-card">
                <h3>Scholarship Report</h3>
                <p>View submitted scholarship opportunities and statuses.</p>
                <a href="report_scholarships.php">View Report</a>
            </div>

            <div class="report-card">
                <h3>User Report</h3>
                <p>List of registered users with their roles and activity.</p>
                <a href="report_users.php">View Report</a>
            </div>

            <div class="report-card">
                <h3>Children Report</h3>
                <p>View all children in the system including fees and welfare data.</p>
                <a href="report_children.php">View Report</a>
            </div>

            <div class="report-card">
                <h3>Verification Logs</h3>
                <p>Track admin payment verifications and timestamps.</p>
                <a href="report-verification.php">View Report</a>
            </div>

            <div class="report-card">
                <h3>Activity Logs</h3>
                <p>Monitor system activities by all users and admins.</p>
                <a href="report_activity.php">View Report</a>
            </div>

            <div class="report-card">
                <h3>Feedback Messages</h3>
                <p>View contact messages and feedback from users.</p>
                <a href="report_feedback.php">View Report</a>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

</body>
</html>
