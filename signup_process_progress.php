<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone Simulator</title>
    <link rel="stylesheet" href="css/phone_screen.css">
    <link rel="stylesheet" href="css/general_theme_signup.css">
    <script>
        // Function to redirect after 3 seconds
        function redirectToIndex() {
            setTimeout(function(){
                window.location.href = "index.php";
            }, 3000); // 3000 milliseconds = 3 seconds
        }
        // Call the function when the page loads
        window.onload = redirectToIndex;
    </script>
</head>
<body>
    <div id="iphone">
        <div id="screen">
            <div class="title-text">
                <?php
                // Check if there's a message to display
                if (isset($_GET['message'])) {
                    echo $_GET['message'];
                } else {
                    echo "here"; // Default text
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
