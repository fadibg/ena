<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $title = $_POST['title'];

    // Generate a unique file name
    function generateUniqueFileName($file) {
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        return $fileName . '_' . time() . '.' . $fileExtension;
    }

    $uniqueImageName = generateUniqueFileName($_FILES['image']);
    $uploadPath = '../uploads/gallery/' . $uniqueImageName;

    // Move the uploaded file to the desired directory
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

    // Insert the data into the database
    $stmt = $pdo->prepare("INSERT INTO gallery (title, image) VALUES (?, ?)");
    $stmt->execute([$title, $uniqueImageName]);

    // Redirect to the control panel or another page
    header("Location: control_panel.php");
    exit();
}
?>
