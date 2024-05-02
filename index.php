<?php
// Check if the user ID cookie is set
if (isset($_COOKIE['user_id'])) {
    // Redirect to index.php
    header("Location: mysite.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone Simulator</title>
    <link rel="stylesheet" href="css/phone_screen.css">
    <link rel="stylesheet" href="css/general_theme_login.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div id="iphone">
        <div id="screen">
            <a href="login.php" class="login-link">
                <span class="login-text">Log Ind</span>
            </a>
            <a href="signup_step1.php" class="signup-link">
                <span class="signup-text">Opret Bruger</span>
            </a>
        </div>
    </div>
</body>

</html>