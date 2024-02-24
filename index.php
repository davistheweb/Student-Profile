<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: student.php");
    exit; // Stop execution after redirect
}

// Assuming your session variable is "student"
$user = $_SESSION["student"];

require_once "database.php";

// Using prepared statement to prevent SQL injection
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the user data
if ($user = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    // User data fetched successfully
} else {
    die("Error, No profile found");
}

?>

<?php if (isset($user)): ?>
        <!-- Your HTML content here -->
    <?php else: ?>
        
    <?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="index.css">
<script src="bootstrap.min.js"></script>
<script src="jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <title>Student Profile</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Student Profile</a>
    <a href="logout.php" style="text-decoration:none;" class="logout text-light px-3 rounded-4 pb-2 bg-danger">Logout</a>
</nav>
<main> 
<h2 class="welcome-student">Welcome To Student Profile</h2>
    

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                        <img src="upload/<?= htmlspecialchars($user["stu_img"]);?>" class="img-radius" alt="User-Profile-Image">
                        <div class="profile-head">
                                    <h5>
                                        <?= htmlspecialchars($user["full_name"]);?>
                                    </h5>
                                    <h6>
                                        <?= htmlspecialchars($user["dept"]);?> Student
                                    </h6>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
                <h6 class="information">Information</h6>    
                <div class="row justify-center">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= htmlspecialchars($user["full_name"]);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= htmlspecialchars($user["email"]);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Degree</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= htmlspecialchars($user["field"]);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Matric.NO</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= htmlspecialchars($user["math"]);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Faculty</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= htmlspecialchars($user["fal"]);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Department</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= htmlspecialchars($user["dept"]);?></p>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

        </main>

        <footer class="build-info">
            <p class="build-name">&copy <script>document.write(new Date().getFullYear())</script> || Built by <a class="build-link" href="https://X.com/davistheweb" target="_blank">Davistheweb</a></p>
        </footer>
</body>
</html>