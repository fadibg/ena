<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM members WHERE email = ?");
    $stmt->execute([$email]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($member && password_verify($password, $member['password'])) {
        echo json_encode(["message" => "Login successful!"]);
        // Create session or token for user
        session_start();
        $_SESSION['user_id'] = $member['id'];
        header("Location: ./members.php");
    } else {
        echo json_encode(["error" => "Invalid credentials!"]);
    }
}
?>
