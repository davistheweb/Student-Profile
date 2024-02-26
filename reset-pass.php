<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require_once __DIR__ . "/database.php";

$sql = "SELECT * FROM student 
        WHERE reset_token_hash = ?";

$stmt = mysqli_stmt_init($mysqli); // Initialize the prepared statement

mysqli_stmt_prepare($stmt, $sql); // Prepare the statement
mysqli_stmt_bind_param($stmt, "s", $token_hash); // Bind parameters
mysqli_stmt_execute($stmt); // Execute the statement

$result = mysqli_stmt_get_result($stmt);

$student = mysqli_fetch_assoc($result);

if($student === null) {
    die("Token not found");
}

if (strtotime($student["expire_reset_token"]) <= time()) {
    die("Token expired");
}

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgotten Password</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
        
            <form action="process-reset-pass.php" method="post">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <h2>Reset Password</h2>
                <div class="input-group">
                    <input type="password" name="password">
                    <i class="ri-eye-line h-password" id="show-password"></i>
                    <label for="">Password</label>
                </div>
                <div class="input-group">
                    <input type="password" name="confirmpassword" id="login-password" required>
                    <i class="ri-eye-line h-password" id="show-login-password"></i>
                    <label for="">Confirm Password</label>
                </div>
                <input type="submit" class="submit-btn" value="Continue" name="login">
            </form>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>
