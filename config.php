<?php

// Base URL of the application (adjust as needed)
define('BASE_URL', 'http://localhost/simple_task_scheduler/');

// Security settings
define('TOKEN_EXPIRATION_TIME', 3600); // Reset token validity in seconds (1 hour)

// Mail settings (for password reset emails)
define('MAIL_FROM', 'no-reply@example.com');
define('MAIL_NAME', 'Simple_task_scheduler Support');

// Function to send emails (basic example, can be enhanced with PHPMailer or similar libraries)
function sendEmail($to, $subject, $message) {
    $headers = "From: " . MAIL_NAME . " <" . MAIL_FROM . ">\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8";

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}