<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/vendor/autoload.php";

// Instantiate PHPMailer object
$mail = new PHPMailer();//(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.example.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "your-user@example.com"; 
$mail->Password = "your-password"; 
$mail->isHTML(true);

return $mail;

?>
