<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];

    // Move image to uploads folder
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/gallery/$image");

    // Insert into the gallery table
    $stmt = $pdo->prepare("INSERT INTO gallery (title, image) VALUES (?, ?)");
    $stmt->execute([$title, $image]);

    echo json_encode(["message" => "Image uploaded successfully!"]);
}
?>
