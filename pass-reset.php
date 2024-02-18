<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(27));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 10);

require_once "database.php";

$sql = "UPDATE students
        SET reset_token = ?,
        expire_reset_token = ?
        WHERE email = ?";

$stmt = mysqli_stmt_init($conn); // Initialize the prepared statement

if (mysqli_stmt_prepare($stmt, $sql)) { // Prepare the statement
    mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email); // Bind parameters
    mysqli_stmt_execute($stmt); // Execute the statement
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt); // Close the statement

mysqli_close($conn); // Close the connection

 

?>