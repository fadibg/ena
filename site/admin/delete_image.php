<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id'])) {
    $galleryId = $_POST['image_id'];


    try {

        $pdo->beginTransaction();
        $stmt = $pdo->prepare("SELECT image FROM gallery WHERE id = ?");
        $stmt->execute([$galleryId]);
        $image = $stmt->fetchColumn();
        if ($image) {
            $imagePath = '../uploads/gallery/' . $image;
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
        }

        $stmt = $pdo->prepare("DELETE FROM gallery WHERE id = ?");
        $stmt->execute([$galleryId]);

        $pdo->commit();

        header("Location: control_panel.php");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log($e->getMessage());

        header("Location: error.php");
        exit();
    }
}
?>
