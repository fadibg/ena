<?php
require_once '../config/db.php';

$stmt = $pdo->query("SELECT * FROM gallery");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($images);
?>
