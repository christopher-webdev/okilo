<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'mail.okilointegratedhub.com'; // SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'info@okilointegratedhub.com'; // Your email address
    $mail->Password = 'okilo_123'; // Your email password
    $mail->SMTPSecure = 'ssl'; // SSL
    $mail->Port = 465; // SMTP Port

    // Sender & Recipient
    $mail->setFrom('info@okilointegratedhub.com', 'Okilo Integrated Services');
    $mail->addAddress('info@okilointegratedhub.com'); // Send to Okilo support

    // Optional: Also notify the sender that their message was received
    if (!empty($_POST["email"])) {
        $mail->addReplyTo($_POST["email"], $_POST["name"]); // User's email
    }

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission: ' . strip_tags($_POST["subject"]);
    $mail->Body = "<strong>Name:</strong> " . strip_tags($_POST["name"]) . "<br>" .
                  "<strong>Email:</strong> " . filter_var($_POST["email"], FILTER_SANITIZE_EMAIL) . "<br><br>" .
                  "<strong>Message:</strong><br>" . nl2br(strip_tags($_POST["message"]));

    $mail->send();
    echo json_encode(["status" => "success", "message" => "Thank you! Your message has been sent."]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Mail error: " . $mail->ErrorInfo]);
}
?>
