<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['user_data'] = array_merge($_SESSION['user_data'], $_POST);
    header("Location: signup_process.php");
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
    <title>Signup Step 3</title>
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
            <a id="back-arrow" href="/signup_step2.php">
                <img src="/content/icons/back-arrow.svg" alt="Back" width="40" height="40">
            </a>
            <!-- Titel -->
            <div class="title-text">Søgninger</div>
            <!-- Input form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <!-- Periode Input -->
                <label for="period">Periode (1-7 days):</label>
                <input type="number" id="period" name="period" min="1" max="7" required>
                <!-- Budget Input -->
                <label for="budget">Budget for periode (DKK):</label>
                <input type="number" id="budget" name="budget" min="80" max="1000" required>
                <!-- Allergier Input -->
                <fieldset>
                    <legend>Allergier:</legend>
                    <input type="checkbox" id="gluten" name="allergies[]" value="gluten">
                    <label for="gluten">Gluten</label><br>
                    <input type="checkbox" id="nødder" name="allergies[]" value="nødder">
                    <label for="nødder">Nødder</label><br>
                    <input type="checkbox" id="mælk" name="allergies[]" value="mælk">
                    <label for="mælk">Mælk</label><br>
                    <input type="checkbox" id="æg" name="allergies[]" value="æg">
                    <label for="æg">Æg</label><br>
                    <input type="checkbox" id="fisk" name="allergies[]" value="fisk">
                    <label for="fisk">Fisk</label><br>
                    <input type="checkbox" id="sojabønner" name="allergies[]" value="sojabønner">
                    <label for="sojabønner">Sojabønner</label><br>
                </fieldset>
                <!-- Præferencer Input -->
                <fieldset>
                    <legend>Præferencer:</legend>
                    <input type="checkbox" id="pescetar" name="preferences[]" value="pescetar">
                    <label for="pescetar">Pescetar</label><br>
                    <input type="checkbox" id="vegetar" name="preferences[]" value="vegetar">
                    <label for="vegetar">Vegetar</label><br>
                    <input type="checkbox" id="veganer" name="preferences[]" value="veganer">
                    <label for="veganer">Veganer</label><br>
                </fieldset>
                <!-- Knap til næste side -->
                <button type="submit">Next</button>
            </form>
        </div>
    </div>
</body>

</html>