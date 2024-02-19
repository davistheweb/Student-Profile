<?php

require_once __DIR__ . "/mailer.php"; // Include mailer.php at the beginning

$email = $_POST["email"];

// Check if $mail is instantiated and not null
if ($mail) {
    $token = bin2hex(random_bytes(27));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 10);

    $mysqli = require_once "database.php";

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

 
    if ($mysqli->affected_rows) {
        $mail->setFrom("noreply@example.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset"; // Fixed typo in the subject
        $mail->Body = <<<END
        Click <a href="http://example.com/reset-password.php?token=$token">here</a>
        to reset your password.
        END;

        try {
            $mail->send();
            echo "Message sent, Check your mail";
        } catch (Exception $e) {
            echo "Unable to send message. Mailer error:{$mail->ErrorInfo}";
        }
    } else {
        echo "No affected rows.";
    }
} else {
    echo "Error: Mailer object not instantiated properly.";
}

mysqli_stmt_close($stmt); // Close the statement

mysqli_close($mysqli); // Close the connection


?>
