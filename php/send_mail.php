<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    exit();
}

// Sanitize input
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
$message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

// Validate required fields
if (empty($name) || empty($lastname) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email format."]);
    exit();
}

// Email configuration
$to = "annaboinalaxman6@gmail.com";
$fromEmail = "noreply@altrushield.com";
$replyToEmail = $email;
$email_subject = "DU Website Form Submission: $subject";

$headers = "From: $name $lastname <$fromEmail>\r\n";
$headers .= "Reply-To: $replyToEmail\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body = "You have received a new message from your contact form:\n\n";
$body .= "Name: $name $lastname\n";
$body .= "Email: $email\n";
$body .= "Subject: $subject\n\n";
$body .= "Message:\n$message\n";

if (mail($to, $email_subject, $body, $headers)) {
    echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to send message."]);
}
?>
