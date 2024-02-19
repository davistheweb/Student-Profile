<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/vendor/autoload.php";

// Instantiate PHPMailer object
$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.example.com"; // Replace with your SMTP server host
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "smartkelvin775@gmail.com"; // Replace with your SMTP username
$mail->Password = "your-password"; // Replace with your SMTP password
$mail->isHTML(true);

return $mail;

?>
