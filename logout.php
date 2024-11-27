<?php
require 'db.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Mark user as logged out
    $stmt = $conn->prepare("UPDATE users SET is_logged_in = 0 WHERE id = :id");
    $stmt->execute([':id' => $userId]);

    session_destroy();
    echo "You have logged out successfully.";
}
?>