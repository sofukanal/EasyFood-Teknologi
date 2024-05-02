<?php
// Check if the form has been submitted
if (isset($_POST['save_shopping_list'])) {
    // Check if the user is logged in
    if (isset($_COOKIE['user_id'])) {
        // Get user ID from the cookie
        $user_id = $_COOKIE['user_id'];

        // Get the shopping list data from the form
        $shopping_list_json = $_POST['shopping_list'];

        // Include database credentials
        require_once('db_credentials.php');

        // Create a database connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Check the database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query to insert the shopping list data
        $stmt = $conn->prepare("INSERT INTO saved_shopping_lists (user_id, shopping_list_json) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $shopping_list_json);
        $stmt->execute();

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();

        // Redirect the user back to the generated shopping list page with a success message
        header("Location: generated_shopping_list.php?success=1");
        exit();
    } else {
        // If the user is not logged in, redirect them to the login page
        header("Location: login.php");
        exit();
    }
} else {
    // If the form was not submitted, redirect the user to the homepage
    header("Location: index.php");
    exit();
}
?>
