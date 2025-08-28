<?php
session_start();
require 'db_connect.php';
include('includes/header.php');

$query = "SELECT childID, fullName FROM Children ORDER BY fullName ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Child to Edit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: url('images/edit-child-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1;
        }

        .form-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 40px;
            width: 90%;
            max-width: 500px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-container h2 {
            color: #0073e6;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
            color: #333;
            text-align: left;
        }

        select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        select:focus {
            border-color: #0073e6;
            box-shadow: 0 0 6px rgba(0, 115, 230, 0.5);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0073e6;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #005bb5;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
            }
            .form-container h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="form-container">
        <h2>Select a Child to Edit Academic Records</h2>
        <form method="GET" action="edit_child.php">
            <label for="childID">Select Child:</label>
            <select name="childID" id="childID" required>
                <option value="">-- Choose Child --</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['childID']; ?>">
                        <?php echo htmlspecialchars($row['fullName']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Edit Child</button>
        </form>
    </div>

<?php include('includes/footer.php'); ?>
</body>
</html>
