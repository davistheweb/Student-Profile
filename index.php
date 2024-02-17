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
    // No user found, handle this case
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body class="bg-success">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Student Profile</a>
    <a href="logout.php" style="text-decoration:none;" class="logout text-light px-3 rounded-4 pb-2 bg-danger">Logout</a>
</nav>

    
<?php if (isset($user)): ?>
        <!-- Your HTML content here -->
    <?php else: ?>
        
    <?php endif; ?>
    <h2 class="welcome-student">Welcome To Student Profile</h2>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">

                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="img/user.png" class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <h6 class="f-w-600"><?= htmlspecialchars($user["full_name"]);?></h6>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Degree</p>
                                            <h6 class="text-muted f-w-400"><?= htmlspecialchars($user["field"]);?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Matric.NO</p>
                                            <h6 class="text-muted f-w-400"><?= htmlspecialchars($user["math"]);?></h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Faculty</p>
                                            <h6 class="text-muted f-w-400"><?= htmlspecialchars($user["fal"]);?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Department</p>
                                            <h6 class="text-muted f-w-400"><?= htmlspecialchars($user["dept"]);?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>