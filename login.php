<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id, password_hash, is_logged_in FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            if ($user['is_logged_in'] == 1) {
                echo "This account is already logged in elsewhere.";
            } else {
                // Mark the user as logged in
                $updateStmt = $conn->prepare("UPDATE users SET is_logged_in = 1 WHERE id = :id");
                $updateStmt->execute([':id' => $user['id']]);
                echo "Login successful!";
            }
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML Form -->
<form action="login.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>