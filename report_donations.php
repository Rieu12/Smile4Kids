<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Report - Smile4Kids</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: url('images/report-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

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

        .container {
            flex: 1;
            padding: 140px 20px 40px;
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

        /* ✅ Search and Filter */
        .search-filter {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 15px;
            gap: 10px;
        }

        .search-filter input, .search-filter select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

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

    <div class="top-nav">
        <h1>Donation Report</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <div class="report-box">
            <h2>Donation Records</h2>

            <!-- ✅ Search & Filter -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search donor, child, code..." onkeyup="filterTable()">
                <select id="statusFilter" onchange="filterTable()">
                    <option value="">All Statuses</option>
                    <option value="Verified">Verified</option>
                    <option value="Pending">Pending</option>
                </select>
                <select id="methodFilter" onchange="filterTable()">
                    <option value="">All Methods</option>
                    <option value="bank">Bank</option>
                    <option value="paybill">Paybill</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <?php
            $result = $conn->query("SELECT Payments.paymentID, Users.fullName AS donor, Children.fullName AS child, payment_method, transaction_code, verified, payment_date FROM Payments JOIN Users ON Payments.userID = Users.userID JOIN Children ON Payments.childID = Children.childID");

            if ($result && $result->num_rows > 0) {
                echo "<table id='donationTable'>";
                echo "<tr>
                        <th>Payment ID</th>
                        <th>Donor</th>
                        <th>Child</th>
                        <th>Payment Method</th>
                        <th>Transaction Code</th>
                        <th>Status</th>
                        <th>Date</th>
                      </tr>";

                while ($row = $result->fetch_assoc()) {
                    $status = $row['verified'] ? "Verified" : "Pending";
                    echo "<tr>
                            <td>".htmlspecialchars($row['paymentID'])."</td>
                            <td>".htmlspecialchars($row['donor'])."</td>
                            <td>".htmlspecialchars($row['child'])."</td>
                            <td>".htmlspecialchars($row['payment_method'])."</td>
                            <td>".htmlspecialchars($row['transaction_code'])."</td>
                            <td>$status</td>
                            <td>".htmlspecialchars($row['payment_date'])."</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-data'>No donation records found.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function filterTable() {
            let searchInput = document.getElementById("searchInput").value.toLowerCase();
            let statusFilter = document.getElementById("statusFilter").value;
            let methodFilter = document.getElementById("methodFilter").value;

            let table = document.getElementById("donationTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let donor = cells[1].textContent.toLowerCase();
                let child = cells[2].textContent.toLowerCase();
                let method = cells[3].textContent;
                let status = cells[5].textContent;

                let matchesSearch = donor.includes(searchInput) || child.includes(searchInput) || cells[4].textContent.toLowerCase().includes(searchInput);
                let matchesStatus = (statusFilter === "" || status === statusFilter);
                let matchesMethod = (methodFilter === "" || method === methodFilter);

                if (matchesSearch && matchesStatus && matchesMethod) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>

<?php include('includes/footer.php'); ?>

</body>
</html>
