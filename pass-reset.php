<?php

require_once __DIR__ . "/mailer.php"; // Include mailer.php at the beginning

$email = $_POST["email"];

// Check if $mail is instantiated and not null
if ($mail) {
    $token = bin2hex(random_bytes(27));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 10);

    $mysqli = require "database.php";

    $sql = "UPDATE students
            SET reset_token = ?,
            expire_reset_token = ?
            WHERE email = ?";

    $stmt = mysqli_stmt_init($mysqli); // Initialize the prepared statement

    if (mysqli_stmt_prepare($stmt, $sql)) { // Prepare the statement
        mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email); // Bind parameters
        mysqli_stmt_execute($stmt); // Execute the statement
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
$Msg = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Forgotten Password</title>
    <link rel='stylesheet' href='css/forgot-pass.css'>
    <link rel='stylesheet' href = 'css/style.css'>
</head>
<body>
    <div class='wrapper'>
        <div class='form-wrapper sign-in'>
            <p>Message Sent, Pls check your mail.</p>
        </div>
    </div>
</body>
</html>";


$CatchErrMsg = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Forgotten Password</title>
    <link rel='stylesheet' href='css/forgot-pass.css'>
    <link rel='stylesheet' href = 'css/style.css'>
</head>
<body>
    <div class='wrapper'>
        <div class='form-wrapper sign-in'>
            <p>Unable to send message. Mailer error:{$mail->ErrorInfo}</p>
        </div>
    </div>
</body>
</html>";
 
$ErrMsg = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Forgotten Password</title>
    <link rel='stylesheet' href='css/forgot-pass.css'>
    <link rel='stylesheet' href = 'css/style.css'>
</head>
<body>
    <div class='wrapper'>
        <div class='form-wrapper sign-in'>
            <p>Mail not found</p>
        </div>
    </div>
</body>
</html>";
 
    if ($mysqli->affected_rows) {
        $mail->setFrom("josiahdave001@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset for student profile"; // Fixed typo in the subject
        $mail->Body = <<<END
        Click <a href="http://localhost/student-profile/reset-pass.php?token=$token">here</a>
        to reset your password.
        END;

        try {
            $mail->send();
            echo $Msg;
        } catch (Exception $e) {
            echo $CatchErrMsg;
        }
    } else {
        echo $ErrMsg;
    }
}

mysqli_stmt_close($stmt); // Close the statement

mysqli_close($mysqli); // Close the connection


?>
