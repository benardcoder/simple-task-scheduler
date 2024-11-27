<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate reset token
            $resetToken = bin2hex(random_bytes(16));
            $updateStmt = $conn->prepare("UPDATE users SET reset_token = :token WHERE id = :id");
            $updateStmt->execute([':token' => $resetToken, ':id' => $user['id']]);

            echo "Password reset link: http://localhost/dashboard/reset_password.php?token=$resetToken";
        } else {
            echo "Email not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML Form -->
<form action="forgot_password.php" method="POST">
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Send Reset Link</button>
</form>