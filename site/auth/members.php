<?php

// Start session to check if user is logged in
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require_once '../config/db.php';

// Get user data from the database
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file uploads
    $fileFields = ['photo', 'passportCopy', 'uaeId', 'medicalLicense', 'resume', 'qualifications'];
    $updateData = [];

    // Define upload directory and check if it exists
    $targetDir = "../uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
    }

    // Loop through the file fields
    foreach ($fileFields as $fileField) {
        if (!empty($_FILES[$fileField]['name'])) {
            // Handle file upload
            $fileName = basename($_FILES[$fileField]['name']);
            $targetFile = $targetDir . $fileName;
            $fileTmpName = $_FILES[$fileField]['tmp_name'];
            $fileSize = $_FILES[$fileField]['size'];
            $fileError = $_FILES[$fileField]['error'];
            $fileType = $_FILES[$fileField]['type'];

            // Check if file uploaded without errors
            if ($fileError === UPLOAD_ERR_OK) {
                // Validate file size (e.g., 5MB max)
                if ($fileSize > 5 * 1024 * 1024) {
                    echo "File is too large (max 5MB).";
                    exit();
                }

                // Validate file type (allow only specific formats)
                $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                if (!in_array($fileType, $allowedTypes)) {
                    echo "Invalid file type. Only JPG, PNG, and PDF are allowed.";
                    exit();
                }

                // Sanitize file name to prevent security risks
                $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName);
                $targetFile = $targetDir . $fileName;

                // Move the uploaded file to the target directory
                if (move_uploaded_file($fileTmpName, $targetFile)) {
                    // Only update the file path if it's different from the current value
                    if ($user[$fileField] !== $targetFile) {
                        $updateData[$fileField] = $targetFile;
                    }
                } else {
                    echo "Error moving file.";
                    exit();
                }
            } else {
                echo "File upload error: " . $fileError;
                exit();
            }
        }
    }

    // Collect and sanitize input data
    $fields = [
        'fullName', 'email', 'title', 'membershipType', 'type', 'gender',
        'emirate', 'po_box', 'requested_society', 'professional_title',
        'level_of_education', 'license_name', 'work_type', 'nationality',
        'emirates_id_number', 'phone_number'
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $newValue = trim($_POST[$field]);
            // Check if new value differs from the old value
            if (!empty($newValue) && $user[$field] !== $newValue) {
                $updateData[$field] = $newValue;
            }
        }
    }

    // Check if there's any data to update
    if (!empty($updateData)) {
        $setClause = implode(', ', array_map(fn($field) => "$field = ?", array_keys($updateData)));
        $stmt = $pdo->prepare("UPDATE members SET $setClause WHERE id = ?");
        $stmt->execute(array_merge(array_values($updateData), [$userId]));
    }

    header("Location: members.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .profile-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 700px;
        }
        .field-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .field-label {
            width: 200px;
            font-weight: bold;
        }
        .field-container span {
            flex-grow: 1;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }
        .field-container input[type="text"],
        .field-container input[type="email"],
        .field-container input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
        }

        .edit-icon {
            margin-left: 10px;
            cursor: pointer;
            width: 10px;
            height: 10px;
        }
        .profile-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #00796b;
        }
        .logout-btn {
            background-color: #d32f2f;
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <h2>User Profile</h2>
            <img src="../uploads/<?php echo htmlspecialchars($user['photo'] ?? 'default.png'); ?>" alt="Profile Picture" style="border-radius: 50%;
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto 20px;">
            <?php
            foreach ($user as $key => $value) {
                if (!in_array($key, ['id', 'password'])) {
                    echo "<div class='field-container'>";
                    echo "<label class='field-label'>" . ucfirst(str_replace('_', ' ', $key)) . ":</label>";
                    echo "<span id='text-{$key}'>" . htmlspecialchars($value) . "</span>";
                    $inputType = in_array($key, ['photo', 'passportCopy', 'uaeId', 'medicalLicense', 'resume', 'qualifications']) ? 'file' : 'text';
                    echo "<input type='{$inputType}' name='{$key}' id='input-{$key}' />";
                    echo "<img src='1416596-200.png' class='edit-icon' data-field='{$key}' alt='Edit'>";
                    echo "</div>";
                }
            }
            ?>
            <input type="submit" value="Save Changes">
        </form>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <script>
        document.querySelectorAll('.edit-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                const field = icon.dataset.field;
                const textElement = document.getElementById(`text-${field}`);
                const inputElement = document.getElementById(`input-${field}`);
                textElement.style.display = 'none';
                inputElement.style.display = 'block';
                inputElement.focus();
            });
        });
    </script>
</body>
</html>
