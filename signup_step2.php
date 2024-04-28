<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['user_data'] = array_merge($_SESSION['user_data'], $_POST);
    header("Location: signup_step3.php");
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
    <title>Signup Step 2</title>
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
            <a id="back-arrow" href="/signup_step1.php">
                <img src="/content/icons/back-arrow.svg" alt="Back" width="40" height="40">
            </a>
            <!-- Titel -->
            <div class="title-text">Sundhed</div>
            <!-- Input form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!-- Køn Input -->
                <select name="gender" required>
                    <option value="">Vælg Biologiske Køn</option>
                    <option value="M">Mand</option>
                    <option value="F">Kvinde</option>
                </select>
                <!-- Alder Input -->
                <input type="number" name="age" placeholder="Alder" required>
                <!-- Vægt Input -->
                <input type="number" name="weight" placeholder="Vægt (kg)" required>
                <!-- Højde Input -->
                <input type="number" name="height" placeholder="Højde (cm)" required>
                <!-- Knap til næste side -->
                <button type="submit">Næste</button>
            </form>
        </div>
    </div>
</body>

</html>