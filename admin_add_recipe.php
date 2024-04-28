<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
</head>
<body>
    <h1>Add Recipe</h1>
    <form action="add_recipe_process.php" method="POST">
        <label for="name">Recipe Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <label for="time">Time (minutes):</label><br>
        <input type="number" id="time" name="time" required><br><br>
        
        <label for="calories">Calories:</label><br>
        <input type="number" id="calories" name="calories" required><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" required><br><br>
        
        <label for="ingredients">Ingredients:</label><br>
        <textarea id="ingredients" name="ingredients" required></textarea><br><br>

        <label for="allergies">Allergies:</label><br>
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
        <label for="sojabønner">Sojabønner</label><br><br>

        <label for="preferences">Preferences:</label><br>
        <input type="checkbox" id="pescetar" name="preferences[]" value="pescetar">
        <label for="pescetar">Pescetar</label><br>
        <input type="checkbox" id="vegetar" name="preferences[]" value="vegetar">
        <label for="vegetar">Vegetar</label><br>
        <input type="checkbox" id="veganer" name="preferences[]" value="veganer">
        <label for="veganer">Veganer</label><br><br>
        
        <input type="submit" value="Add Recipe">
    </form>
</body>
</html>
