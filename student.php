<?php
    session_start();
   if(isset($_SESSION["student"]) && isset ($_SESSION['id'])) {
    header("Location: index.php");
    exit();
   }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
rel="stylesheet">
    <link rel="stylesheet" href="student.css">
</head>
<body>
    <div class="container grid">
        <div class="title">WELCOME TO STUDENT PROFILE</div>
        <div class="links flex">
            <a href="login&register.php" class="link">Login</a>
            <i>OR</i>
            <a href="login&register.php#register" class="link">Create Account</a>
        </div>
    </div>
</body>
</html>