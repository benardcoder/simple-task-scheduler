<?php
session_start();
require 'db.php';

// Redirect to dashboard if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <p>Please log in or register to access the system.</p>

        <div class="auth-links">
            <a href="login.php" class="button">Login</a>
            <a href="register.php" class="button">Register</a>
        </div>
    </div>
</body>
</html>