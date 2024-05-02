<?php
// Check om user_id er sat. Hvis ikke bruger er logget ind sendes bruger til startsiden
if (!isset($_COOKIE['user_id'])) {
    // Sender bruger til index.php
    header("Location: index.php");
    exit();
}

// Inkluder databaselegitimationsoplysninger
require_once('db_credentials.php');

// Opret en forbindelse til databasen
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Tjek forbindelsen til databasen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hent brugerens data fra databasen ved hjælp af user_id fra cookies
$user_id = $_COOKIE['user_id'];
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql);

// Tjek, om databasen returnerede en række
if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();
    // Assign user data to variables
    $weight = $row['weight'];
    $height = $row['height'];
    $period = $row['period'];
    $budget = $row['budget'];
    $allergies_and_preferences = $row['allergies_and_preferences'];
} else {
    // If user data is not found, redirect back to mysite.php with an error message
    header("Location: mysite.php?error=user_data_not_found");
    exit();
}

// Close the connection
$conn->close();
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
    <link rel="stylesheet" href="css/shopping_list_input.css">
</head>

<!-- Hjemmesiden -->

<body>
    <!-- iPhone -->
    <div id="iphone">
        <!-- iPhone skærm -->
        <div id="screen">
            <!-- Fixed bar -->
            <div id="fixed-bar">
                <a href="mysite.php"><button><img src="/content/icons/back-arrow-icon.svg" alt="Indstillinger"></button></a>
                <a></a>
            </div>
            <!-- Form for shopping list input -->
            <div id="content-wrapper">
                <form action="random_recipes.php" method="post">
                    <!-- Weight input -->
                    <label for="weight">Vægt (kg):</label>
                    <input type="number" id="weight" name="weight" value="<?php echo $weight; ?>" required>

                    <!-- Height input -->
                    <label for="height">Højde (cm):</label>
                    <input type="number" id="height" name="height" value="<?php echo $height; ?>" required>

                    <!-- Period input -->
                    <label for="period">Periode (1-7 days):</label>
                    <input type="number" id="period" name="period" min="1" max="7" value="<?php echo $period; ?>" required>

                    <!-- Budget input -->
                    <label for="budget">Budget for periode (DKK):</label>
                    <input type="number" id="budget" name="budget" min="80" max="1000" value="<?php echo $budget; ?>" required>

                    <!-- Add hidden inputs for gender and age -->
                    <input type="hidden" name="gender" value="<?php echo $row['gender']; ?>">
                    <input type="hidden" name="age" value="<?php echo $row['age']; ?>">
                    <input type="hidden" name="allergies_and_preferences" value="<?php echo htmlspecialchars($allergies_and_preferences); ?>">

                    <!-- Submit button -->
                    <button type="submit">Generer Indkøbsliste</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>