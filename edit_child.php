<?php
session_start();
require 'db_connect.php';
include('includes/header.php');

if (!isset($_GET['childID'])) {
    die("No child selected.");
}

$childID = intval($_GET['childID']);

$stmt = $conn->prepare("SELECT * FROM Children WHERE childID = ?");
$stmt->bind_param("i", $childID);
$stmt->execute();
$result = $stmt->get_result();
$child = $result->fetch_assoc();

if (!$child) {
    die("Child not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Child Academic Records</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('images/edit-child-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            overflow-y: auto;
        }

        .overlay {
            position: fixed;
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
            width: 90%;
            max-width: 1000px;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-container h2 {
            text-align: center;
            font-size: 2rem;
            color: #0073e6;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 12px;
            color: #333;
        }

        select, input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        select:focus,
        input:focus,
        textarea:focus {
            border-color: #0073e6;
            box-shadow: 0 0 8px rgba(0,115,230,0.4);
            outline: none;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
            background: #0073e6;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #005bb5;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
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
        <h2>Edit Academic Records for <?php echo htmlspecialchars($child['fullName']); ?></h2>
        <form method="POST" action="update_child.php">
            <input type="hidden" name="childID" value="<?php echo $childID; ?>">

            <label>Level of Learning:</label>
            <select name="level">
                <option value="Primary" <?php if ($child['level_of_learning'] == 'Primary') echo 'selected'; ?>>Primary</option>
                <option value="High School" <?php if ($child['level_of_learning'] == 'High School') echo 'selected'; ?>>High School</option>
                <option value="University" <?php if ($child['level_of_learning'] == 'University') echo 'selected'; ?>>University</option>
            </select>

            <label>Academic Progress:</label>
            <textarea name="academic_progress"><?php echo htmlspecialchars($child['academic_progress']); ?></textarea>

            <label>Annual Fees:</label>
            <input type="number" name="fees" value="<?php echo $child['annual_fees']; ?>" required>

            <label>Health Status:</label>
            <textarea name="health_status"><?php echo htmlspecialchars($child['health_status']); ?></textarea>

            <label>Disabled?</label>
            <select name="is_disabled">
                <option value="0" <?php if (!$child['is_disabled']) echo 'selected'; ?>>No</option>
                <option value="1" <?php if ($child['is_disabled']) echo 'selected'; ?>>Yes</option>
            </select>

            <label>Hobbies:</label>
            <textarea name="hobbies"><?php echo htmlspecialchars($child['hobbies']); ?></textarea>

            <label>Background:</label>
            <textarea name="background"><?php echo htmlspecialchars($child['background']); ?></textarea>

            <button type="submit">Update Child</button>
        </form>
    </div>

<?php include('includes/footer.php'); ?>
</body>
</html>
