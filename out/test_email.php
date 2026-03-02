

<?php
$to = "nwokwulechristopher@gmail.com"; // Replace with your actual email
$subject = "Test Email from PHP Mail";
$message = "This is a test email sent from PHP mail() function.";
$headers = "From: info@okilointergratedservices.com"; // Use an email from your domain

if (mail($to, $subject, $message, $headers)) {
    echo "Mail sent successfully!";
} else {
    echo "Mail sending failed!";
}
?>