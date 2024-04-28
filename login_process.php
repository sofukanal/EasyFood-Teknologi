<?php
// Start the session
session_start();

// Include database credentials
require_once('db_credentials.php');

// Create a connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Construct SQL query
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

// Execute the query
$result = $conn->query($sql);

// Check if the query returned a row
if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();
    $user_id = $row['user_id']; // Assuming 'user_id' is the column name for the user ID
    
    // Set user ID as a cookie
    setcookie('user_id', $user_id, time() + (3600), "/"); // Cookie expires in 1 hour
    // Redirect to the index.php page
    header("Location: mysite.php");
    exit();
} else {
    // If login fails, redirect back to the login page with an error message
    header("Location: login.php?error=1");
    exit();
}

// Close the connection
$conn->close();
?>