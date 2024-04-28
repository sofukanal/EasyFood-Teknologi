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
            <!-- 3 knapper i midten af skærmen -->
            <a href="shopping_list_input.php" class="action-button">Lav Indkøbsliste</a>
            <a href="snack_input.php" class="action-button">Lav Snack</a>
            <a href="saved_shopping_lists.php" class="action-button">Gemte Indkøbslister</a>
            <!-- Burger menu knap i toppen til venstre -->
            <button id="burger-menu-button" class="burger-menu-button">&#9776;</button>
            <!-- Log ud knap -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <button class="logout-button" type="submit" name="logout">Log ud</button>
            </form>
        </div>
    </div>
</body>

</html>