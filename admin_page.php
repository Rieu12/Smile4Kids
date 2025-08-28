<?php
session_start();

// Check if the user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include('includes/header.php');
?>

<div class="admin-dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Admin)</h1>
    <p>Select a report or action below:</p>

    <div class="admin-actions">
        <a href="report_users.php" class="admin-btn">User Accounts Report</a>
        <a href="report_donations.php" class="admin-btn">Donations Report</a>
        <a href="report_scholarships.php" class="admin-btn">Scholarship Submissions</a>
        <a href="report_children.php" class="admin-btn">Child Welfare Records</a>
        <a href="report_feedback.php" class="admin-btn">Contact/Feedback Messages</a>
        <a href="report_finance.php" class="admin-btn">Financial Overview</a>
        <a href="report_activity.php" class="admin-btn">System Activity Log</a>
        <a href="admin_add_user.php" class="admin-btn">Add New User</a>
        <a href="admin_query.php" class="admin-btn">Query & Data Search</a>
        <a href="logout.php" class="admin-btn logout">Logout</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>
