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
// Generate the shopping list data and encode it into JSON format
$list_of_dishes_per_day_json = json_encode($list_of_dishes_per_day);

// Redirect the user to the generated_shopping_list.php page with the shopping list data
header("Location: generated_shopping_list.php?list_of_dishes_per_day=" . urlencode($list_of_dishes_per_day_json));
exit();
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
    <link rel="stylesheet" href="css/generated_shopping_list.css">
</head>

<!-- Hjemmesiden -->

<body>
    <!-- iPhone -->
    <div id="iphone">
        <!-- iPhone skærm -->
        <div id="screen">
            <!-- Fixed bar -->
            <div id="fixed-bar">
                <a href="mysite.php"><button><img src="/content/icons/back-arrow-icon.svg" alt="Back"></button></a>
                <form action="save_shopping_list.php" method="post">
                    <input type="hidden" name="shopping_list" value="<?php echo htmlspecialchars($list_of_dishes_per_day_json); ?>">
                    <button type="submit" name="save_shopping_list"><img src="/content/icons/save-icon.svg" alt="Save"></button>
                </form>
                <!-- Add more buttons here if needed -->
            </div>
            <!-- Invisible box for scrolling -->
            <div id="content-wrapper">
                <!-- Generated shopping list content -->
                <?php
                // Output the generated shopping list content
                if (!empty($list_of_dishes_per_day_json)) {
                    // Decode JSON data into PHP array
                    $list_of_dishes_per_day = json_decode($list_of_dishes_per_day_json, true);
                    // Output the shopping list data
                    echo "<h2>Generated Shopping List</h2>";
                    echo "<ul>";
                    foreach ($list_of_dishes_per_day as $day => $dishes) {
                        echo "<li><strong>Day $day:</strong></li>";
                        echo "<ul>";
                        echo "<li>Breakfast: Recipe ID {$dishes['breakfast_id']}</li>";
                        echo "<li>Lunch: Recipe ID {$dishes['lunch_id']}</li>";
                        echo "<li>Dinner: Recipe ID {$dishes['dinner_id']}</li>";
                        echo "</ul>";
                    }
                    echo "</ul>";
                } else {
                    // No shopping list data available
                    echo "<p>No shopping list data available.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>