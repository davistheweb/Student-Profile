<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgotten Password</title>
    <link rel="stylesheet" href="css/forgot-pass.css">
    <link rel="stylesheet" href = "css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
        
            <form action="pass-reset.php" method="post">
                <h2>Reset Password</h2>
                <div class="input-group">
                    <input type="email" name="email" id="email" required>
                    <label for="">Email</label>
                </div>
                <button>Send</button>

                </form>
        </div>
    </div>
</body>
</html>