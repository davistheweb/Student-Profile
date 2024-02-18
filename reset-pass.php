<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgotten Password</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
        
            <form action="" method="post">
                <h2>Reset Password</h2>
                <div class="input-group">
                    <input type="password" name="password" required>
                    <i class="ri-eye-line h-password" id="show-password"></i>
                    <label for="">Password</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="login-password" required>
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