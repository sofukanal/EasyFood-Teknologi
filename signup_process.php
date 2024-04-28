<?php
session_start();

// Retrieve session data
$user_data = $_SESSION['user_data'];

// Include database credentials
require_once('db_credentials.php');

// Create a connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape user input for security and convert to utf-8 encoding
$first_name = mb_convert_encoding($conn->real_escape_string($user_data['first_name']), "utf-8");
$last_name = mb_convert_encoding($conn->real_escape_string($user_data['last_name']), "utf-8");
$email = mb_convert_encoding($conn->real_escape_string($user_data['email']), "utf-8");
$password = $conn->real_escape_string($user_data['password']);
$gender = mb_convert_encoding($conn->real_escape_string($user_data['gender']), "utf-8");
$age = $conn->real_escape_string($user_data['age']);
$weight = $conn->real_escape_string($user_data['weight']);
$height = $conn->real_escape_string($user_data['height']);
$period = $conn->real_escape_string($user_data['period']);
$budget = $conn->real_escape_string($user_data['budget']);

// Convert arrays to JSON strings and ensure utf-8 encoding
$allergies_and_preferences = json_encode([
    'allergies' => isset($user_data['allergies']) ? $user_data['allergies'] : [],
    'preferences' => isset($user_data['preferences']) ? $user_data['preferences'] : []
], JSON_UNESCAPED_UNICODE); // JSON_UNESCAPED_UNICODE ensures that special characters are preserved

// Example SQL query, modify as per your database schema
$sql = "INSERT INTO users (first_name, last_name, email, password, gender, age, weight, height, period, budget, allergies_and_preferences)
VALUES ('$first_name', '$last_name', '$email', '$password', '$gender', '$age', '$weight', '$height', '$period', '$budget', '$allergies_and_preferences')";

try {
    if ($conn->query($sql) === TRUE) {
        // Close the connection
        $conn->close();

        // Redirect to signup_process_progress.php with success message
        header("Location: signup_process_progress.php?message=Ny bruger oprettet succesfuldt.");
        exit;
    } else {
        throw new Exception("Der opstod en uventet fejl. Prøv igen.");
    }
} catch (mysqli_sql_exception $e) {
    // If the error is due to a duplicate entry
    if ($e->getCode() == 1062) {
        // Close the connection
        $conn->close();

        // Redirect to signup_process_progress.php with error message
        header("Location: signup_process_progress.php?message=Denne email er allerede i brug. Prøv med en anden.");
        exit;
    } else {
        // Close the connection
        $conn->close();

        // Redirect to signup_process_progress.php with error message
        header("Location: signup_process_progress.php?message=Der opstod en uventet fejl. Prøv igen.");
        exit;
    }
}

// Clear session data
session_unset();
session_destroy();
?>