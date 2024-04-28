<?php
// Check om user_id er sat. Hvis ikke bruger er logget ind sendes bruger til startsiden
if (!isset($_COOKIE['user_id'])) {
    // Sender bruger til index.php
    header("Location: index.php");
    exit();
}

// Log ud kode
if (isset($_POST['logout'])) {
    // Sletter user_id cookie
    setcookie('user_id', '', time() - 3600, '/'); // Indstiller udløbstiden for log ind til fortiden
    // Sender bruger til index.php
    header("Location: index.php");
    exit();
}
?>
<!-- Browser indstillinger -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Side navn -->
    <title>iPhone Simulator</title>
    <!-- Udseende -->
    <link rel="stylesheet" href="css/phone_screen.css">
    <link rel="stylesheet" href="css/general_theme_mysite.css">
    <link rel="stylesheet" href="css/mysite.css">
</head>

<!-- Hjemmesiden -->
<body>
    <!-- iPhone -->
    <div id="iphone">
        <!-- iPhone skærm -->
        <div id="screen">
            
        </div>
    </div>
</body>

</html>