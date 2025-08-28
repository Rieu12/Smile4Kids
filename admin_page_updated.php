<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require_once 'db_connect.php';

// Fetch latest unverified donations
$donationsQuery = "SELECT Users.fullName AS donor, Children.fullName AS child, Payments.payment_date
                   FROM Payments
                   JOIN Users ON Payments.userID = Users.userID
                   JOIN Children ON Payments.childID = Children.childID
                   WHERE Payments.verified = 0
                   ORDER BY Payments.payment_date DESC
                   LIMIT 5";
$donationsResult = $conn->query($donationsQuery);

// Fetch latest scholarship opportunities
$scholarshipQuery = "SELECT opportunityID, link, document_path, created_at
                     FROM scholarshipopportunities
                     WHERE status = 'pending'
                     ORDER BY created_at DESC
                     LIMIT 5";
$scholarshipResult = $conn->query($scholarshipQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Smile4Kids</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* ================ */
        /* CSS Variables */
        /* ================ */
        :root {
            --primary-color: #0073e6;
            --primary-dark: #005bb5;
            --danger-color: #cc0000;
            --danger-dark: #a00000;
            --text-dark: #333;
            --text-light: #f8f9fa;
            --bg-light: rgba(255, 255, 255, 0.95);
            --shadow-sm: 0 4px 10px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 8px 20px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.3);
            --border-radius-sm: 8px;
            --border-radius-md: 10px;
            --border-radius-lg: 12px;
            --transition-fast: 0.2s ease;
            --transition-normal: 0.3s ease;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
        }

        /* ================ */
        /* Base Styles */
        /* ================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: url('images/admin-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text-dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        /* ================ */
        /* Utility Classes */
        /* ================ */
        .container {
            width: 90%;
            max-width: 1800px;
            margin: 0 auto;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .justify-between {
            justify-content: space-between;
        }

        .justify-center {
            justify-content: center;
        }

        .items-center {
            align-items: center;
        }

        .gap-sm {
            gap: var(--spacing-sm);
        }

        .gap-md {
            gap: var(--spacing-md);
        }

        .gap-lg {
            gap: var(--spacing-lg);
        }

        .text-center {
            text-align: center;
        }

        .text-primary {
            color: var(--primary-color);
        }

        /* ================ */
        /* Component Styles */
        /* ================ */

        /* Top Navigation */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 115, 230, 0.95);
            padding: var(--spacing-md) var(--spacing-xl);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: var(--shadow-lg);
            z-index: 1000;
        }

        .top-nav__title {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .logout-btn {
            background: var(--danger-color);
            color: white;
            padding: 10px 18px;
            border-radius: var(--border-radius-sm);
            font-weight: bold;
            transition: background var(--transition-normal), 
                        transform var(--transition-fast);
        }

        .logout-btn:hover {
            background: var(--danger-dark);
            transform: scale(1.05);
        }

        /* Main Content */
        .main-content {
            padding-top: 120px;
            padding-bottom: 60px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--spacing-lg);
        }

        /* Cards Container */
        .cards-container {
            background: var(--bg-light);
            padding: var(--spacing-xl);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-md);
            animation: fadeIn 0.8s ease;
        }

        /* Dashboard Card */
        .dashboard-card {
            background: white;
            padding: var(--spacing-lg);
            border-radius: var(--border-radius-md);
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: transform var(--transition-normal), 
                        box-shadow var(--transition-normal);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .welcome-message {
            grid-column: 1 / -1;
            font-size: 2rem;
            margin-bottom: var(--spacing-md);
            color: var(--primary-color);
        }

        /* Notifications Panel */
        .notifications-panel {
            background: var(--bg-light);
            padding: var(--spacing-xl);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            margin-bottom: var(--spacing-lg);
            animation: fadeIn 0.5s ease;
        }

        .notifications__header {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            color: var(--primary-color);
            font-size: 1.4rem;
        }

        .notifications__section {
            margin-bottom: var(--spacing-lg);
        }

        .notifications__title {
            margin-bottom: var(--spacing-sm);
            color: var(--text-dark);
        }

        .notifications__list {
            padding-left: 10px;
        }

        .notifications__item {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-size: 0.95rem;
        }

        .notifications__link {
            color: var(--primary-color);
            margin-left: var(--spacing-sm);
            transition: color var(--transition-fast);
        }

        .notifications__link:hover {
            text-decoration: underline;
        }

        .empty-state {
            color: #666;
            font-style: italic;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ================ */
        /* Responsive Styles */
        /* ================ */
        @media (max-width: 992px) {
            .cards-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .top-nav__title {
                font-size: 1.4rem;
            }
            
            .welcome-message {
                font-size: 1.8rem;
            }
            
            .dashboard-card {
                font-size: 1.2rem;
                padding: var(--spacing-md);
            }
        }

        @media (max-width: 576px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
            
            .top-nav {
                padding: var(--spacing-md);
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="top-nav">
        <h1 class="top-nav__title">Admin Dashboard</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Notifications Panel -->
            <section class="notifications-panel">
                <h2 class="notifications__header">
                    <i class="fas fa-bell"></i>
                    Notifications
                </h2>
                
                <div class="notifications__section">
                    <h3 class="notifications__title">Pending Donations</h3>
                    <?php if ($donationsResult->num_rows > 0): ?>
                        <ul class="notifications__list">
                            <?php while ($donation = $donationsResult->fetch_assoc()): ?>
                                <li class="notifications__item">
                                    <strong><?php echo htmlspecialchars($donation['donor']); ?></strong> donated for 
                                    <em><?php echo htmlspecialchars($donation['child']); ?></em> 
                                    (<?php echo date("d M Y", strtotime($donation['payment_date'])); ?>)
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p class="empty-state">No new donations to review</p>
                    <?php endif; ?>
                </div>
                
                <div class="notifications__section">
                    <h3 class="notifications__title">New Scholarship Opportunities</h3>
                    <?php if ($scholarshipResult->num_rows > 0): ?>
                        <ul class="notifications__list">
                            <?php while ($sch = $scholarshipResult->fetch_assoc()): ?>
                                <li class="notifications__item">
                                    New scholarship posted on 
                                    <?php echo date("d M Y", strtotime($sch['created_at'])); ?> –
                                    <a href="report_scholarships.php?opportunityID=<?php echo $sch['opportunityID']; ?>" 
                                       class="notifications__link">
                                        Review <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <p class="empty-state">No new scholarship opportunities</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Dashboard Cards -->
            <div class="cards-container">
                <h2 class="welcome-message">Welcome, Admin!</h2>
                
                <div class="dashboard-card" onclick="location.href='reports-dashboard.php';">
                    <i class="fas fa-chart-bar"></i> Reports
                </div>
                
                <div class="dashboard-card" onclick="location.href='admin_add_child.php';">
                    <i class="fas fa-child"></i> Add Child
                </div>
                
                <div class="dashboard-card" onclick="location.href='verify-payments.php';">
                    <i class="fas fa-hand-holding-usd"></i> Approve Donations
                </div>
                
                <div class="dashboard-card" onclick="location.href='edit-select-child.php';">
                    <i class="fas fa-graduation-cap"></i> Edit Child 
                </div>
                
                <div class="dashboard-card" onclick="location.href='admin_add_user.php';">
                    <i class="fas fa-users-cog"></i> Manage Users
                </div>
            </div>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>
</body>
</html>