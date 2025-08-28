<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}
require 'db_connect.php';
?>

<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smile4Kids - Children List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            background: url('images/children-bg.jpg') no-repeat center center fixed; /* ✅ Replace with your image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            width: 90%;
            max-width: 1200px;
            height: 90%;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            animation: fadeIn 0.8s ease;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #0073e6;
            margin-bottom: 2rem;
        }

        .children-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .child-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .child-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .child-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .child-card strong {
            color: #0073e6;
        }

        .child-card p {
            font-size: 1rem;
            margin: 0.4rem 0;
            color: #444;
        }

        .child-card a {
            display: inline-block;
            margin-top: 1rem;
            padding: 10px 18px;
            background: #0073e6;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .child-card a:hover {
            background: #005bb5;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar */
        .container::-webkit-scrollbar {
            width: 8px;
        }
        .container::-webkit-scrollbar-track {
            background: #ddd;
        }
        .container::-webkit-scrollbar-thumb {
            background: #0073e6;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }
            .child-card img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Select a Child to Support</h2>

    <div class="children-grid">
        <?php
        $result = $conn->query("SELECT * FROM Children WHERE is_funded = 0");

        if ($result->num_rows > 0) {
            while ($child = $result->fetch_assoc()) {
                $age = $child['birthdate'] ? date_diff(date_create($child['birthdate']), date_create('today'))->y : 'N/A';
                $image = $child['image_path'] ? $child['image_path'] : 'default.jpg';

                echo "<div class='child-card'>";
                echo "<img src='uploads/" . htmlspecialchars($image) . "' alt='Child Image'>";
                echo "<p><strong>Name:</strong> " . htmlspecialchars($child['fullName']) . "</p>";
                echo "<p><strong>Level:</strong> " . htmlspecialchars($child['level_of_learning']) . "</p>";
                echo "<p><strong>Annual Fees:</strong> KES " . number_format($child['annual_fees'], 2) . "</p>";
                echo "<p><strong>Age:</strong> " . $age . " years</p>";
                echo "<p><strong>Hobbies:</strong> " . htmlspecialchars($child['hobbies']) . "</p>";
                echo "<a href='make-payment.php?childID=" . $child['childID'] . "'>Sponsor This Child</a>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center; font-size:1.3rem; color:#444;'>No children available.</p>";
        }

        $conn->close();
        ?>
    </div>
</div>

</body>
</html>

<?php include('includes/footer.php'); ?>
