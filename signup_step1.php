<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['user_data'] = $_POST;
    header("Location: signup_step2.php");
    exit;
}

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
    <title>Signup Step 1</title>
    <link rel="stylesheet" href="css/phone_screen.css">
    <link rel="stylesheet" href="css/general_theme_signup.css">
    <link rel="stylesheet" href="css/signup.css">
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
            <div class="title-text">Generelt</div>
            <!-- Input form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!-- Fornavn Input -->
                <input type="text" name="first_name" placeholder="Fornavn" required>
                <!-- Efternavn Input -->
                <input type="text" name="last_name" placeholder="Efternavn" required>
                <!-- Email Input -->
                <input type="email" name="email" placeholder="Email" required>
                <!-- Kodeord Input -->
                <input type="password" name="password" placeholder="Kodeord" required>
                <!-- Knap til næste side -->
                <button type="submit">Næste</button>
            </form>
        </div>
    </div>
</body>
</html>