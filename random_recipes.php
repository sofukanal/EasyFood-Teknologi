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
    <link rel="stylesheet" href="css/random_shopping_list.css">
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
                <a href="mysite.php"><button><img src="/content/icons/save-icon.svg" alt="Save"></button></a>

                <!-- Add more buttons here if needed -->
            </div>
            <!-- Content wrapper -->
            <div id="content-wrapper">
                <?php
                $weight = $_POST['weight'];
                $height = $_POST['height'];
                $period = (int)$_POST['period'];
                $budget = $_POST['budget'];
                $gender = $_POST['gender'];
                $age = $_POST['age'];
                $allergies_and_preferences = $_POST['allergies_and_preferences'];

                // Include database credentials and connect to the database
                require_once('db_credentials.php');
                $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
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
                    echo "<div class='day-container'>";
                    echo "<h2>Dag $day</h2>"; // Day heading
                    echo "<ul>";
                    echo "<li><span class='meal-type'>Morgenmad:</span>" . $meals['breakfast'] . "</li>";
                    echo "<li><span class='meal-type'>Frokost:</span>" . $meals['lunch'] . "</li>";
                    echo "<li><span class='meal-type'>Aftensmad:</span>" . $meals['dinner'] . "</li>";
                    echo "</ul>";
                    echo "</div>"; // Close day-container div
                }


                // Function to get a random recipe for a given meal type
                function getRandomRecipe($mealType)
                {
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