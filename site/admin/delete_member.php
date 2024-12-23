<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberId = $_POST['member_id'];

    $stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
    $stmt->execute([$memberId]);

    header("Location: control_panel.php");
}
?>
