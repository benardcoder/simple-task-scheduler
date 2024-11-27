<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['newPassword'];

    // Hash the new password
    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = :token");
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Update the password
            $updateStmt = $conn->prepare("UPDATE users SET password_hash = :password, reset_token = NULL WHERE id = :id");
            $updateStmt->execute([':password' => $newPasswordHash, ':id' => $user['id']]);

            echo "Password reset successful!";
        } else {
            echo "Invalid or expired token.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!-- HTML Form -->
<form action="reset_password.php" method="POST">
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <input type="password" name="newPassword" placeholder="New Password" required>
    <button type="submit">Reset Password</button>
</form>