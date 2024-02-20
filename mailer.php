<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/vendor/autoload.php";

// Instantiate PHPMailer object
$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.example.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "userexample@mail.com"; 
$mail->Password = "your-password"; 
$mail->isHTML(true);

return $mail;

?>
