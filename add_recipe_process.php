<?php
// Include database credentials
require_once('db_credentials.php');

// Create a connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $conn->real_escape_string($_POST['name']);
$description = $conn->real_escape_string($_POST['description']);
$time = (int)$_POST['time'];
$calories = (int)$_POST['calories'];
$price = (float)$_POST['price'];
$ingredients_raw = $_POST['ingredients'];

// Parse ingredients string into array
$ingredients = [];
foreach (explode("\n", $ingredients_raw) as $ingredient) {
    $parts = explode(":", $ingredient);
    if (count($parts) == 2) {
        $ingredient_name = trim($parts[0]);
        $ingredient_quantity = trim($parts[1]);
        // Convert ingredient name and quantity to UTF-8 encoding
        $ingredient_name = mb_convert_encoding($ingredient_name, "UTF-8");
        $ingredient_quantity = mb_convert_encoding($ingredient_quantity, "UTF-8");
        $ingredients[$ingredient_name] = $ingredient_quantity;
    }
}

// Convert allergies and preferences arrays to comma-separated strings
$allergies = isset($_POST['allergies']) ? implode(', ', $_POST['allergies']) : '';
$preferences = isset($_POST['preferences']) ? implode(', ', $_POST['preferences']) : '';

// Insert query
$sql = "INSERT INTO dinner_recipes (name, description, time, calories, price, ingredients, allergies_and_preferences)
        VALUES ('$name', '$description', $time, $calories, $price, '" . json_encode($ingredients, JSON_UNESCAPED_UNICODE) . "', '$allergies, $preferences')";

if ($conn->query($sql) === TRUE) {
    echo "Recipe added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
