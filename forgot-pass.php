<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgotten Password</title>
    <link rel="stylesheet" href="forgot-pass.css">
    <link rel="stylesheet" href = "style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
        
            <form action="pass-reset.php" method="post">
                <h2>We are sorry,<br> Password reset is Unavaliable<br>Reset Password (...Coming Soon)</h2>
                <div class="input-group">
                    <input type="email" name="email" id="email" required>
                    <label for="">Email</label>
                </div>
                <button>Send</button>

                <div class="forgot-pass" style="margin-top:2px;">
                    <a href="http://example.com/reset-password.php?token=$token">Click here to Reset</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>