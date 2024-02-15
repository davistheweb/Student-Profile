<?php
    session_start();
   if(isset($_SESSION["student"])) {
    header("Location: index.php");
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet" 
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-up">

            <?php
             if (isset($_POST["submit"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["confirm_password"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();
                if (empty($name) OR empty($email) OR empty($password) OR empty($confirmPassword)) {
                    array_push($errors, "Field Cannot Be Empty");
                }

                if (!Filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors,"Email is not valid!");
                }

                if (strlen($password)<8) {
                    array_push($errors, "Password must be at least, more than 8 characters");
                }

                if ($password!==$confirmPassword) {
                    array_push($errors,"Your password does not match");
                }

                require_once "database.php";

                $sql = "SELECT * FROM students WHERE email = '$email'";

                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if($rowCount>0) {
                    array_push($errors, "Email already exists");
                }
                if (count($errors)>0) {
                    foreach($errors as $error){
                    echo "<p class='alert alert-danger'>$error</p>";
                   
                }
                }
                else {
                    //insert data in database

                    
                    $sql = "INSERT INTO students (full_name, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareState = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareState) {
                        mysqli_stmt_bind_param($stmt, "sss",$name, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class= 'alert alert-success'>Registration successful.</div>";
                    }
                    else{
                        die("Something Went Wrong");
                    }

                }
             }
            ?>
            <form action="login&register.php" method="post" id="registerstu">
                <h2>Sign Up</h2>
                <div class="input-group">
                    <input type="text" name="name" required>
                    <label>Name</label>
                </div>
                <div class="input-group">
                    <input type="email"  name="email" autocomplete="off" required>
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" required>
                    <label>Confirm Password</label>
                </div>
                <input type="submit" name="submit" value="Sign Up" class="submit-btn">
                <div class="sign-link">
                    <p>Already have an account? <a class="signIn-link">Sign In</a></p>
                </div>
            </form>
        </div>
        <div class="form-wrapper sign-in">
        <?php 
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"]; 

                require_once "database.php";
                $sql = "SELECT * FROM students WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["student"] = "yes";
                        header("Location: index.php");
                        die();
                    } else {
                        echo"<p class='alert alert danger'>Password does not match</p>";
                    }
                }

                else {
                    echo"<p class='alert alert danger'>Email does not exist</p>";
                }
            }
        ?>
            <form action="login&register.php" method="post">
                <h2>Login</h2>
                <div class="input-group">
                    <input type="email" name="email">
                    <label for="">Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password">
                    <label for="">Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <input type="submit" class="submit-btn" value="Login" name="login">
                <div class="sign-link">
                    <p>Don't have an account? <a class="signUp-link">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        //Because Script Wasn't working, So i had to put the SCript here

        document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.wrapper');
    const signUpLink = document.querySelector('.signUp-link');
    const signInLink = document.querySelector('.signIn-link');

    signUpLink.addEventListener('click', () => {
        console.log('Sign Up link clicked');
        wrapper.classList.add('animate-signIn');
        wrapper.classList.remove('animate-signUp');
    });

    signInLink.addEventListener('click', () => {
        console.log('Sign In link clicked');
        wrapper.classList.add('animate-signUp');
        wrapper.classList.remove('animate-signIn');
    });
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>
    
</body>

</html>
