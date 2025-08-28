<?php
session_start();
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Child - Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh; /* ✅ Use min-height instead of fixed height */
            background: url('images/add-child-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* ✅ Align to top */
            padding: 40px 0; /* ✅ Add spacing */
            overflow-y: auto; /* ✅ Enable vertical scrolling */
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            width: 80%;
            max-width: 1800px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease;
        }

        .form-container h2 {
            text-align: center;
            font-size: 3rem;
            color: #0073e6;
            margin-bottom: 20px;
        }

        form label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 12px;
        }

        form input,
        form select,
        form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1.2rem;
            transition: 0.3s;
        }

        form input:focus,
        form textarea:focus,
        form select:focus {
            border-color: #0073e6;
            box-shadow: 0 0 6px rgba(0, 115, 230, 0.4);
            outline: none;
        }

        #image-preview {
            margin-top: 15px;
            display: none;
            text-align: center;
        }

        #image-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            border: 2px solid #0073e6;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 14px;
            background: #0073e6;
            color: white;
            font-size: 2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #005bb5;
            transform: scale(1.03);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-container {
                width: 95%;
                padding: 20px;
            }
            .form-container h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Child</h2>
    <form method="POST" action="submit_child.php" enctype="multipart/form-data">
        <label>Full Name:</label>
        <input type="text" name="fullName" required>

        <label>Level of Learning:</label>
        <select name="level">
            <option value="Primary">Primary</option>
            <option value="High School">High School</option>
            <option value="University">University</option>
        </select>

        <label>Date of Birth:</label>
        <input type="date" name="birthdate" required>

        <label>Academic Progress:</label>
        <textarea name="academic_progress" rows="3"></textarea>

        <label>Annual Fees (KES):</label>
        <input type="number" name="fees" required>

        <label>Health Status:</label>
        <textarea name="health_status" rows="3"></textarea>

        <label>Disabled?</label>
        <select name="is_disabled">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>

        <label>Hobbies:</label>
        <textarea name="hobbies" rows="3"></textarea>

        <label>Background:</label>
        <textarea name="background" rows="3"></textarea>

        <label>Upload Child Image:</label>
        <input type="file" name="child_image" id="child_image" accept="image/*" onchange="previewImage(event)">

        <div id="image-preview">
            <p>Image Preview:</p>
            <img id="preview-img" src="#" alt="Child Image Preview">
        </div>

        <label>Upload Certificate/Transcript:</label>
        <input type="file" name="document_file" accept=".pdf,.jpg,.png,.doc,.docx">

        <button type="submit">Add Child</button>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("preview-img");
    const previewContainer = document.getElementById("image-preview");

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = "block";
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = "none";
    }
}
</script>

<?php include('includes/footer.php'); ?>

</body>
</html>
