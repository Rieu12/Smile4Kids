<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$query = "SELECT 
            p.transaction_code,
            p.payment_date,
            p.verified_at,
            p.verified_by,
            u.fullName AS donorName,
            a.fullName AS adminName,
            c.fullName AS childName
          FROM Payments p
          JOIN Users u ON p.userID = u.userID
          JOIN Children c ON p.childID = c.childID
          LEFT JOIN Users a ON p.verified_by = a.userID
          WHERE p.verified = 1
          ORDER BY p.verified_at DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            background: url('images/verification-bg.jpg') no-repeat center center fixed; /* ✅ Replace with actual image */
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        /* ✅ Navigation Bar */
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

        /* ✅ Main Container */
        .container {
            flex: 1;
            padding: 140px 20px 40px; /* avoid nav overlap */
            display: flex;
            justify-content: center;
        }

        .report-box {
            background: rgba(255, 255, 255, 0.95);
            width: 95%;
            max-width: 1800px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease;
        }

        .report-box h2 {
            text-align: center;
            font-size: 2rem;
            color: #0073e6;
            margin-bottom: 20px;
        }

        /* ✅ Search & Filter */
        .search-filter {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 15px;
            gap: 10px;
        }

        .search-filter input,
        .search-filter select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        /* ✅ Table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1rem;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #0073e6;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .report-box {
                padding: 1rem;
            }
            table, th, td {
                font-size: 0.9rem;
            }
            .search-filter {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

    <!-- ✅ Top Navigation -->
    <div class="top-nav">
        <h1>Verification Report</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- ✅ Main Content -->
    <div class="container">
        <div class="report-box">
            <h2>Verified Payment Logs</h2>

            <!-- ✅ Search & Filter -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search donor, child, transaction..." onkeyup="filterTable()">
                <select id="adminFilter" onchange="filterTable()">
                    <option value="">All Admins</option>
                    <?php
                    $admins = $conn->query("SELECT DISTINCT u.fullName FROM Users u JOIN Payments p ON u.userID = p.verified_by WHERE p.verified = 1");
                    if ($admins && $admins->num_rows > 0) {
                        while ($a = $admins->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($a['fullName']) . "'>" . htmlspecialchars($a['fullName']) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <table id="verificationTable">
                    <tr>
                        <th>Transaction Code</th>
                        <th>Child</th>
                        <th>Donor</th>
                        <th>Verified By</th>
                        <th>Verification Time</th>
                        <th>Payment Date</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['transaction_code']); ?></td>
                            <td><?php echo htmlspecialchars($row['childName']); ?></td>
                            <td><?php echo htmlspecialchars($row['donorName']); ?></td>
                            <td><?php echo htmlspecialchars($row['adminName'] ?? 'Admin'); ?></td>
                            <td><?php echo date("d M Y, H:i", strtotime($row['verified_at'])); ?></td>
                            <td><?php echo date("d M Y", strtotime($row['payment_date'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p class="no-data">No verifications found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function filterTable() {
            let searchInput = document.getElementById("searchInput").value.toLowerCase();
            let adminFilter = document.getElementById("adminFilter").value;

            let table = document.getElementById("verificationTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let transaction = cells[0].textContent.toLowerCase();
                let child = cells[1].textContent.toLowerCase();
                let donor = cells[2].textContent.toLowerCase();
                let admin = cells[3].textContent;

                let matchesSearch = transaction.includes(searchInput) || child.includes(searchInput) || donor.includes(searchInput);
                let matchesAdmin = (adminFilter === "" || admin === adminFilter);

                rows[i].style.display = (matchesSearch && matchesAdmin) ? "" : "none";
            }
        }
    </script>

<?php include('includes/footer.php'); ?>

</body>
</html>
