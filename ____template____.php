<?php
// Check if user_id is set. If not, redirect the user to the homepage
if (!isset($_COOKIE['user_id'])) {
    // Redirect the user to index.php
    header("Location: index.php");
    exit();
}
?>
<!-- Browser settings -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>iPhone Simulator</title>
    <!-- Appearance -->
    <link rel="stylesheet" href="css/phone_screen.css">
    <link rel="stylesheet" href="css/general_theme_mysite.css">
    <link rel="stylesheet" href="css/mysite.css">
</head>

<!-- Website content -->

<body>
    <!-- iPhone -->
    <div id="iphone">
        <!-- iPhone screen -->
        <div id="screen">
            <!-- Fixed bar -->
            <div id="fixed-bar">
                <a href="mysite.php"><button><img src="/content/icons/back-arrow-icon.svg" alt="Back"></button></a>
                <a href="mysite.php"><button><img src="/content/icons/back-arrow-icon.svg" alt="Back"></button></a>

                <!-- Add more buttons here if needed -->
            </div>
            <!-- Content wrapper -->
            <div id="content-wrapper">
                <?php
                // Generate random recipes for each day
                for ($day = 1; $day <= $period; $day++) {
                    $meals = array();

                    // Generate random breakfast recipe
                    $meals['breakfast'] = getRandomRecipe('breakfast');

                    // Generate random lunch recipe
                    $meals['lunch'] = getRandomRecipe('lunch');

                    // Generate random dinner recipe
                    $meals['dinner'] = getRandomRecipe('dinner');

                    // Output the meals for each day
                    echo "<ul>";
                    echo "<li><strong>Day $day:</strong></li>";
                    echo "<li><strong>Breakfast:</strong> " . $meals['breakfast'] . "</li>";
                    echo "<li><strong>Lunch:</strong> " . $meals['lunch'] . "</li>";
                    echo "<li><strong>Dinner:</strong> " . $meals['dinner'] . "</li>";
                    echo "</ul>";
                }

                // Function to get a random recipe for a given meal type
                function getRandomRecipe($mealType) {
                    global $conn;
                    // Select a random recipe from the database for the given meal type
                    $sql = "SELECT name FROM " . $mealType . "_recipes ORDER BY RAND() LIMIT 1";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        return $row['name'];
                    } else {
                        return "No recipe available";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
