<?php
require '../config/db.php'; // Include database connection

header('Content-Type: application/json');

try {
    // Get current date
    $currentDate = date('Y-m-d');

    // Fetch events that are today or in the future
    $stmt = $pdo->prepare("SELECT *
                           FROM events
                           WHERE event_date >= :currentDate
                           ORDER BY event_date ASC");
    $stmt->execute(['currentDate' => $currentDate]);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($events);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
