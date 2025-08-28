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
    <title>Feedback Report - Smile4Kids</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            background: url('images/feedback-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
        }

        /* ✅ Navigation */
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
        <h1>Feedback Report</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="container">
        <div class="report-box">
            <h2>Contact Messages</h2>

            <!-- ✅ Search & Filter -->
            <div class="search-filter">
                <input type="text" id="searchInput" placeholder="Search name, email, subject..." onkeyup="filterTable()">
                <select id="subjectFilter" onchange="filterTable()">
                    <option value="">All Subjects</option>
                    <?php
                    $subjects = $conn->query("SELECT DISTINCT subject FROM ContactMessages");
                    while ($sub = $subjects->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($sub['subject']) . "'>" . htmlspecialchars($sub['subject']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <?php
            $result = $conn->query("SELECT id, name, email, subject, message, created_at FROM ContactMessages");

            if ($result && $result->num_rows > 0) {
                echo "<table id='feedbackTable'>";
                echo "<tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                      </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".htmlspecialchars($row['id'])."</td>
                            <td>".htmlspecialchars($row['name'])."</td>
                            <td>".htmlspecialchars($row['email'])."</td>
                            <td>".htmlspecialchars($row['subject'])."</td>
                            <td>".htmlspecialchars($row['message'])."</td>
                            <td>".htmlspecialchars($row['created_at'])."</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-data'>No feedback messages found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function filterTable() {
            let searchInput = document.getElementById("searchInput").value.toLowerCase();
            let subjectFilter = document.getElementById("subjectFilter").value;

            let table = document.getElementById("feedbackTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let name = cells[1].textContent.toLowerCase();
                let email = cells[2].textContent.toLowerCase();
                let subject = cells[3].textContent;

                let matchesSearch = name.includes(searchInput) || email.includes(searchInput) || subject.toLowerCase().includes(searchInput);
                let matchesSubject = (subjectFilter === "" || subject === subjectFilter);

                rows[i].style.display = (matchesSearch && matchesSubject) ? "" : "none";
            }
        }
    </script>

<?php include('includes/footer.php'); ?>

</body>
</html>
