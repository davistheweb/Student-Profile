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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
     rel="stylesheet" 
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
     crossorigin="anonymous">
     <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-up">

            
            <form action="login&register.php" method="post" id="register">
            <h2>Sign Up</h2>
            <?php
             if (isset($_POST["submit"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $field = $_POST["field"];
                $math = $_POST["matric"];
                $fal = $_POST["fal"];
                $dept = $_POST["dept"];
                $password = $_POST["password"];
                $confirmPassword = $_POST["confirm_password"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();
                if (empty($name) OR empty($email) OR empty($field) OR empty($math) OR empty($fal) OR empty($dept) OR empty($password) OR empty($confirmPassword)) {
                    array_push($errors, "Field Cannot Be Empty");
                }

                if (!Filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors,"Email is not valid!");
                }

                if (strlen($password)<8) {
                    array_push($errors, "Password must be at least, more than 8 characters");
                }

                if ( ! preg_match("/[a-z]/i", $password)) {
                    array_push($errors, "Password must contain on letter");
                }

                if ( ! preg_match ("/[0-9]/", $password)) {
                    array_push($errors, "Password must contain digits");
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

                    
                    $sql = "INSERT INTO students (full_name, email, field, math, fal, dept, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareState = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareState) {
                        mysqli_stmt_bind_param($stmt, "sssssss",$name, $email, $field, $math, $fal, $dept, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class= 'alert alert-success'>Registration successful.</div>";
                    }
                    else{
                        die("Something Went Wrong");
                    }

                }
             }
            ?>
                
                <div class="input-group">
                    <input type="text" name="name" required>
                    <label>Name</label>
                </div>
                <div class="input-group">
                    <input type="email"  name="email" autocomplete="off" required>
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="text" name="field" required>
                    <label>Field, Eg:Master deg</label>
                </div>
                <div class="input-group">
                    <input type="text" name="matric" required>
                    <label>Matric.No</label>
                </div>
                <div class="input-group">
                    <input type="text" name="fal" required>
                    <label>Falculty</label>
                </div>
                <div class="input-group">
                    <input type="text" name="dept" required>
                    <label>Department</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" required>
                    <i class="ri-eye-line h-password" id="show-password"></i>
                    <label>Password</label>
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" id="password" required>
                    <label>Confirm Password</label>
                </div>
                <input type="submit" name="submit" value="Sign Up" class="submit-btn">
                <div class="sign-link">
                    <p>Already have an account? <a class="signIn-link">Sign In</a></p>
                </div>
            </form>
        </div>
        <div class="form-wrapper sign-in">
        
            <form action="login&register.php" method="post">
                <h2>Login</h2>
                <?php 
            $is_invalid = false;

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
                        session_regenerate_id();
                        $_SESSION["student"] = $user["id"];
                        header("Location: index.php");
                        die();
                    } else {
                        echo"<p class='alert alert danger'>Password does not match</p>";
                    }
                }

                else {
                    echo"<p class='alert alert danger'>Email does not exist</p>";
                }

                $is_invalid = true;
            }
        ?>
                <?php if ($is_invalid): ?>
                    <em>Invalid Login</em>
                    <?php endif; ?>

                <div class="input-group">
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="loginpassword" required>
                    <i class="ri-eye-line h-password" id="showloginpassword"></i>
                    <label for="">Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <input type="submit" class="submit-btn" value="Continue" name="login">
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

const password = document.getElementById('password');
const showPassword = document.getElementById('show-password').addEventListener

('click', function() {
    isPasswordVisible = !isPasswordVisible;
    if (isPasswordVisible) {
        if(password.type == "password") {
            password.type = "text";
        }
        showPassword.innerHTML = '<i class="ri-eye-off-line"></i>';
    } else {
        
        password.type = "password"
        showPassword.innerHTML ='<i class="ri-eye-line"></i>';
    }
});

let isPasswordVisible = false;

const loginpassword = document.getElementById('loginpassword');
const showLoginPassword = document.getElementById('showloginpassword').addEventListener

('click', function() {
    isLoginPasswordVisible = !isLoginPasswordVisible;
    if (isLoginPasswordVisible) {
        if(password.type == "password") {
            password.type = "text";
        }
        showLoginPassword.innerHTML = '<i class="ri-eye-off-line"></i>';
    } else {
        
        password.type = "password"
        showLoginPassword.innerHTML ='<i class="ri-eye-line"></i>';
    }
});

let isLoginPasswordVisible = false;
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>
    
</body>

</html>
