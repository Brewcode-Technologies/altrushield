<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "annaboinalaxman6@gmail.com"; 
    $fromEmail = "noreply@annaboinalaxman6@gmail.com";
    $replyToEmail = $email;

    $email_subject = "DU Website Form Submission: $subject";
    $headers = "From: $name $lastname <$fromEmail>\r\n";
    $headers .= "Reply-To: $replyToEmail\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $body = "You have received a new message from your contact form:\n\n";
    $body .= "Name: $name $lastname\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n\n";
    $body .= "Message:\n$message\n";

    if (mail($to, $email_subject, $body, $headers)) {
        echo "<script>alert('Message sent successfully!'); window.location.href = 'https://altrushield.com/contact.html';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to send message. Please try again later.'); window.history.back();</script>";
    }
} else {
    echo "Invalid request method.";
}
?>
