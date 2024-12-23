<?php
session_start();
require '../config/db.php';

// Check if the member is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../");
    exit();
}

// Get the member ID from the session
$memberId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Begin a transaction
        $pdo->beginTransaction();

        // Step 1: Retrieve the file paths related to the member
        $stmt = $pdo->prepare("SELECT photo, passportCopy, uaeId, medicalLicense, resume, qualifications FROM members WHERE id = ?");
        $stmt->execute([$memberId]);
        $files = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if files are available
        if ($files) {
            // Step 2: Delete each file
            foreach ($files as $filePath) {
                if ($filePath && file_exists("../uploads/$filePath")) {
                    unlink("../uploads/$filePath"); // Delete the file
                }
            }
        }

        // Step 3: Delete the member from the database
        $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
        $stmt->execute([$memberId]);

        // Commit the transaction
        $pdo->commit();

        // Destroy the session
        session_destroy();

        // Redirect to homepage or confirmation page
        header("Location: ../../");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        $pdo->rollBack();

        // Optional: Log the error message
        error_log($e->getMessage());

        // Redirect to an error page or show an error message
        header("Location: ../../error.php");
        exit();
    }
}
?>
