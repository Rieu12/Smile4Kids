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
    <title>Children Report - Smile4Kids</title>
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

        /* Top Navigation */
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

        /* Container */
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

        /* Search & Filter */
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

        /* Table */
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
        <h1>Children Report</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <div class="report-box">
            <h2>Registered Children</h2>

            <!-- Search & Filter -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search name, level..." onkeyup="filterTable()">
                <select id="disabilityFilter" onchange="filterTable()">
                    <option value="">All</option>
                    <option value="1">Disabled</option>
                    <option value="0">Not Disabled</option>
                </select>
            </div>

            <?php
            $result = $conn->query("SELECT childID, fullName, level_of_learning, annual_fees, is_disabled, created_at FROM Children");

            if ($result && $result->num_rows > 0) {
                echo "<table id='childrenTable'>";
                echo "<tr>
                        <th>Child ID</th>
                        <th>Full Name</th>
                        <th>Level</th>
                        <th>Annual Fees</th>
                        <th>Disabled</th>
                        <th>Created At</th>
                      </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".htmlspecialchars($row['childID'])."</td>
                            <td>".htmlspecialchars($row['fullName'])."</td>
                            <td>".htmlspecialchars($row['level_of_learning'])."</td>
                            <td>KES ".number_format($row['annual_fees'], 2)."</td>
                            <td>".($row['is_disabled'] ? "Yes" : "No")."</td>
                            <td>".htmlspecialchars($row['created_at'])."</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-data'>No child records found.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function filterTable() {
            let searchInput = document.getElementById("searchInput").value.toLowerCase();
            let disabilityFilter = document.getElementById("disabilityFilter").value;

            let table = document.getElementById("childrenTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let name = cells[1].textContent.toLowerCase();
                let level = cells[2].textContent.toLowerCase();
                let isDisabled = cells[4].textContent;

                let matchesSearch = name.includes(searchInput) || level.includes(searchInput);
                let matchesDisability = (disabilityFilter === "" || 
                                         (disabilityFilter === "1" && isDisabled === "Yes") || 
                                         (disabilityFilter === "0" && isDisabled === "No"));

                rows[i].style.display = (matchesSearch && matchesDisability) ? "" : "none";
            }
        }
    </script>

<?php include('includes/footer.php'); ?>

</body>
</html>
