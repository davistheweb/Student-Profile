<?php
    session_start();
   if ( isset($_SESSION["student"]) && isset ($_SESSION['id'])) {
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
     <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" 
     defer></script>
     <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>


   <div class="show-instro" id="show-intro">

   <div class="intro-body">
    <span id="close-intro">&times;</span>

    <div class="intro-content">
    <h4 class="intro-title">Welcome To Student Profile.</h4>

    <p class="intro-subtitle">Caution</p>
    <p class="intro-info">* Password Length Must be Up to, or <br>
    more than 8 Characters.</p>
    <p class="intro-info">* Password Must Contain Alphabet.</p>
    <p class="intro-info">* Password Must Contain Digits.</p>

    </div>
    

    </div>
   </div>
    <div class="wrapper">
        <div class="form-wrapper sign-up">

            
            <form action="login&register.php" enctype="multipart/form-data" method="post" id="register">
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
                    $stu_img = $_FILES['student-img'];

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();
                    if (empty($name) || empty($password) || empty($confirmPassword)) {
                        array_push($errors, "Field Cannot Be Empty");
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Email is not valid!");
                    }

                    if (strlen($password) < 8) {
                        array_push($errors, "Password must be at least 8 characters long");
                    }

                    if (!preg_match("/[a-z]/i", $password)) {
                        array_push($errors, "Password must contain at least one letter");
                    }

                    if (!preg_match("/[0-9]/", $password)) {
                        array_push($errors, "Password must contain at least one digit");
                    }

                    if ($password !== $confirmPassword) {
                        array_push($errors, "Your password does not match");
                    }

                    require_once "database.php";

                    $sql = "SELECT * FROM students WHERE email = ?";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $rowCount = mysqli_num_rows($result);

                    if ($rowCount > 0) {
                        array_push($errors, "Email already exists");
                    }

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<p class='alert alert-danger'>$error</p>";
                        }
                    } else {
                        if (isset($_FILES["student-img"])) {
                            $img_name = $_FILES['student-img']['name'];
                            $tmp_name = $_FILES['student-img']['tmp_name'];
                            $error = $_FILES['student-img']['error'];

                            if ($error === 0) {
                                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                                $img_allowed = strtolower($img_ex);

                                $allowed_img = array('jpg', 'jpeg', 'png');

                                if (in_array($img_allowed, $allowed_img)) {
                                    $new_img = uniqid($name, true) . '.' . $img_allowed;
                                    $upload_img = 'upload/' . $new_img;
                                    move_uploaded_file($tmp_name, $upload_img);

                                    $sql = "INSERT INTO students (full_name, email, field, math, fal, dept, password, stu_img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_stmt_init($conn);
                                    $prepareState = mysqli_stmt_prepare($stmt, $sql);
                                    if ($prepareState) {
                                        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $field, $math, $fal, $dept, $passwordHash, $new_img);
                                        mysqli_stmt_execute($stmt);
                                        echo "<div class='alert alert-success'>Registration successful.</div>";
                                    }
                                } else {
                                    echo "Invalid image file type.";
                                }
                            }
                        } else {
                            die("Something went wrong");
                        }
                    }
                }


                
                /* else {
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

                } */
             
            ?>

            
                
                <div class="input-group">
                    <input type="text" name="name" required="required">
                    <label>Name</label>
                </div>
                <div class="input-group">
                    <input type="email"  name="email" autocomplete="off" required="required">
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="text" name="field" required="required">
                    <label>Field, Eg:Master deg</label>
                </div>
                <div class="input-group">
                    <input type="text" name="matric" required="required">
                    <label>Matric.No</label>
                </div>
                <div class="input-group">
                    <input type="text" name="fal" required="required">
                    <label>Falculty</label>
                </div>
                <div class="input-group">
                    <input type="text" name="dept" required ="required">
                    <label>Department</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" required ="required">
                    <i class="ri-eye-line h-password" id="show-password"></i>
                    <label>Password</label>
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" id="confirm-password" required="required">
                    <i class="ri-eye-line h-password" id="show-confirm-password"></i>
                    <label>Confirm Password</label>
                </div>
                <div class="input-group mb-0">
                    <label class="form-label">Student Img</label>
                    <input type="file" class="file form-control" style="border:0;
                     background:#12ddee" name="student-img" 
                     required="required">
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
                $sql = "SELECT * FROM students WHERE email = ?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        session_regenerate_id();
                        $_SESSION["student"] = $user["id"];
                        header("Location: index.php");
                        die();
                    } else {
                        echo"<p class='alert alert-danger'>Password does not match</p>";
                    }
                }

                else {
                    echo"<p class='alert alert-danger'>Email does not exist</p>";
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
                    <input type="password" name="password" id="login-password" required>
                    <i class="ri-eye-line h-password" id="show-login-password"></i>
                    <label for="">Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="forgot-pass.php">Forgot Password?</a>
                </div>
                <input type="submit" class="submit-btn" value="Continue" name="login">
                <div class="sign-link">
                    <p>Don't have an account? <a class="signUp-link">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>

    <style>
        .show-instro {
        position: absolute;
       background-color: rgba(0, 0, 0, 0.2);
        width:100%;
        height:100%;
        z-index:1000;
        display: flex;
        justify-content:center;
        align-items:center;
        transition: .3s ease;

    }

    .intro-body {
        background-color:#000;
        padding:2.5%;
        border-radius: 10px;
        
    }

    .intro-body #close-intro {
        background-color:#12ddee;
        width:1.5rem;
        height:1.5rem;
        diplay:flex;
        font-size:20px;
        color:#fff;
        cursor:pointer;
        border-radius:5px;
        margin-left:auto;
        display:inline-block;
        text-align:center;
        
        align-items: flex-end;
    }

    .intro-content {
        padding-top: 1rem;
    }

    .intro-subtitle {
        text-decoration:underline;
        color:#ff0000;
    }

    .intro-title,
    .intro-info 
    {
        color: #fff;
    }

  
    </style>

    <script src="login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
    crossorigin="anonymous"></script>


    <script>
           function displayIntro() {
        const showIntro = document.querySelector('#show-intro');
        const closeIntro = document.querySelector('#close-intro');
    
        showIntro.style.display = 'flex';
    
        setTimeout(() => {
            showIntro.style.display = 'none';
        }, 5500);
    
        closeIntro.addEventListener('click', () => {
            showIntro.style.display = 'none';
        });
    }
    
        window.onload = displayIntro;
    
    </script>
    
</body>

</html>
