<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone Simulator</title>
    <link rel="stylesheet" href="css/phone_screen.css">
    <link rel="stylesheet" href="css/general_theme_login.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<!-- Hjemmesiden -->
<body>
    <!-- iPhone -->
    <div id="iphone">
        <!-- iPhone skærm -->
        <div id="screen">
            <!-- Pil tilbage til startsiden -->
            <a id="back-arrow" href="/index.php">
                <img src="/content/icons/back-arrow.svg" alt="Back" width="40" height="40">
            </a>
            <!-- Titel -->
            <div class="title-text">Log Ind</div>
            <!-- Login form -->
            <form action="login_process.php" method="post">
                <!-- Email Input -->
                <input type="email" name="email" placeholder="Email" required>
                <!-- Kodeord Input -->
                <input type="password" name="password" placeholder="Kodeord" required>
                <!-- Knap til næste side -->
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
