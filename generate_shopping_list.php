<?php
// Hent informationerne fra input siden
$weight = $_POST['weight'];
$height = $_POST['height'];
$period = (int)$_POST['period'];
$budget = $_POST['budget'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$allergies_and_preferences = $_POST['allergies_and_preferences'];

// Udregnede kalorie indtag ud fra biologiske køn
if ($gender === 'M') {
    $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
} elseif ($gender === 'F') {
    $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
} else {
    $bmr = 0;
}

// Udregn daglige kalorie indtag
$daily_calorie_intake = round(($bmr * 1.375)*0.9);
$daily_breakfast_intake = round($daily_calorie_intake * 0.27);
$daily_lunch_intake = round($daily_calorie_intake * 0.32);
$daily_dinner_intake = round($daily_calorie_intake * 0.41);

// Print de forskellige udregnede værdier
echo "Value of weight: $weight<br>";
echo "Value of height: $height<br>";
echo "Value of gender: $gender<br>";
echo "Value of age: $age<br>";
echo "Value of bmr: $bmr<br>";
echo "(10 * $weight) + (6.25 * $height) - (5 * $age) + 5<br>";
echo "Value of daily calorie intake: $daily_calorie_intake kcal<br>";
echo "Value of breakfast intake: $daily_breakfast_intake kcal<br>";
echo "Value of lunch intake: $daily_lunch_intake kcal<br>";
echo "Value of dinner intake: $daily_dinner_intake kcal<br><br>";

// Inkluder databaselegitimationsoplysninger
require_once('db_credentials.php');

// Opret en forbindelse til databasen
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Tjek forbindelsen til databasen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Laver lister
$list_of_dishes_per_day = array();
$list_of_used_recipes_for_breakfast = array();
$list_of_used_recipes_for_lunch = array();
$list_of_used_recipes_for_dinner = array();


// Find opskrifter for hver dag
for ($day = 1; $day <= $period; $day++) {
    // Sætter kalorie forbrug for den dag
    $breakfast_intake = $daily_breakfast_intake;
    $lunch_intake = $daily_lunch_intake;
    $dinner_intake = $daily_dinner_intake;

    // Hvis personen ikke er allergiker eller veganer bliver de anbefaldet et glas mælk
    if (strpos($allergies_and_preferences, 'mælk') !== false || strpos($allergies_and_preferences, 'veganer') !== false) {
        // Tilføjer mandel mælk til indkøbslisten
        $breakfast_intake -= 100;
        $breakfast_drink = "mandel_mælk";
        echo "Tilføj mandelmælk til indkøbsliste<br>";
    } else {
        // Tilføjer mælk til indkøbslisten
        $breakfast_intake -= 100;
        $breakfast_drink = "let_mælk";
        echo "Tilføj mælk til indkøbsliste<br>";
    }
    echo "Value of breakfast intake: $breakfast_intake kcal<br>";


    // --------------------Morgenmad--------------------

    $where_clause = '';
    if (!empty($allergies_and_preferences)) {
        $allergies_and_preferences_array = json_decode($allergies_and_preferences, true);
        if (isset($allergies_and_preferences_array['allergies']) && count($allergies_and_preferences_array['allergies']) > 0) {
            $allergies = implode("','", $allergies_and_preferences_array['allergies']);
            $where_clause .= "AND allergies_and_preferences NOT LIKE '%{$allergies}%'";
        }
        if (isset($allergies_and_preferences_array['preferences']) && count($allergies_and_preferences_array['preferences']) > 0) {
            $preferences = implode("','", $allergies_and_preferences_array['preferences']);
            $where_clause .= "AND allergies_and_preferences NOT LIKE '%{$preferences}%'";
        }
    }

    // Konverter rækken af ​​brugte opskrifts-id'er til morgenmad til en kommasepareret streng
    $used_recipes_for_breakfast_str = !empty($list_of_used_recipes_for_breakfast) ? implode(',', $list_of_used_recipes_for_breakfast) : '';

    // Tilføj en betingelse for at kontrollere, om $used_recipes_for_breakfast_str ikke er tom, før du ændrer SQL-forespørgslen
    $used_recipes_condition = !empty($used_recipes_for_breakfast_str) ? "AND recipe_id NOT IN ($used_recipes_for_breakfast_str)" : '';

    // Opdater WHERE-sætningen med betingelsen for at ekskludere brugte opskrifter
    $where_clause .= $used_recipes_condition;

    // Rediger SQL-forespørgslen til at inkludere WHERE-klausulen
    $sql = "SELECT * FROM breakfast_recipes 
        WHERE calories <= $breakfast_intake 
        $where_clause
        ORDER BY ABS(calories - $breakfast_intake) LIMIT 1";
    $result = $conn->query($sql);

    // Ser om der er fundet en opskrift 
    if ($result->num_rows > 0) {
        // Henter opskrift data
        $row = $result->fetch_assoc();

        // Åbner dataen til opskriften data
        $breakfast_id = $row['recipe_id'];

        // Tilføjer eller fjerner ekstra kalorier der er til overs fra morgenmaden til frokost opskriften
        $lunch_intake += $breakfast_intake - $row['calories'];

        // Tilføjer opskriften til listen over allerede brugte opskrifter
        $list_of_used_recipes_for_breakfast[] = $breakfast_id;
    }

    // --------------------Frokost--------------------

    // Konverter rækken af ​​brugte opskrifts-id'er til morgenmad til en kommasepareret streng
    $used_recipes_for_lunch_str = !empty($list_of_used_recipes_for_lunch) ? implode(',', $list_of_used_recipes_for_lunch) : '';

    // Tilføj en betingelse for at kontrollere, om $used_recipes_for_breakfast_str ikke er tom, før du ændrer SQL-forespørgslen
    $used_recipes_condition = !empty($used_recipes_for_lunch_str) ? "AND recipe_id NOT IN ($used_recipes_for_lunch_str)" : '';

    // Opdater WHERE-sætningen med betingelsen for at ekskludere brugte opskrifter
    $where_clause .= $used_recipes_condition;

    // Rediger SQL-forespørgslen til at inkludere WHERE-klausulen
    $sql = "SELECT * FROM lunch_recipes 
        WHERE calories <= $lunch_intake 
        $where_clause
        ORDER BY ABS(calories - $lunch_intake) LIMIT 1";
    $result = $conn->query($sql);

    // Ser om der er fundet en opskrift 
    if ($result->num_rows > 0) {
        // Henter opskrift data
        $row = $result->fetch_assoc();

        // Åbner dataen til opskriften data
        $lunch_id = $row['recipe_id'];

        // Tilføjer eller fjerner ekstra kalorier der er til overs fra frokosten til aftensmads opskriften
        $dinner_intake += $lunch_intake - $row['calories'];

        // Tilføjer opskriften til listen over allerede brugte opskrifter
        $list_of_used_recipes_for_lunch[] = $lunch_id;
    }

    // --------------------Aftensmad--------------------

    // Konverter rækken af ​​brugte opskrifts-id'er til morgenmad til en kommasepareret streng
    $used_recipes_for_dinner_str = !empty($list_of_used_recipes_for_dinner) ? implode(',', $list_of_used_recipes_for_dinner) : '';

    // Tilføj en betingelse for at kontrollere, om $used_recipes_for_breakfast_str ikke er tom, før du ændrer SQL-forespørgslen
    $used_recipes_condition = !empty($used_recipes_for_dinner_str) ? "AND recipe_id NOT IN ($used_recipes_for_dinner_str)" : '';

    // Opdater WHERE-sætningen med betingelsen for at ekskludere brugte opskrifter
    $where_clause .= $used_recipes_condition;

    // Rediger SQL-forespørgslen til at inkludere WHERE-klausulen
    $sql = "SELECT * FROM dinner_recipes 
        WHERE calories <= $dinner_intake 
        $where_clause
        ORDER BY ABS(calories - $dinner_intake) LIMIT 1";
    $result = $conn->query($sql);

    // Ser om der er fundet en opskrift 
    if ($result->num_rows > 0) {
        // Henter opskrift data
        $row = $result->fetch_assoc();

        // Åbner dataen til opskriften data
        $dinner_id = $row['recipe_id'];

        // Tilføjer opskriften til listen over allerede brugte opskrifter
        $list_of_used_recipes_for_dinner[] = $dinner_id;
    }

    // --------------------Tilføj Opskrifter Til Indkøbslisten--------------------


    // Tilføj en ny dags opskrifter til indkøbslisten
    $list_of_dishes_per_day[] = array(
        'breakfast_id' => $breakfast_id,
        'breakfast_drink' => $breakfast_drink,
        'lunch_id' => $lunch_id,
        'dinner_id' => $dinner_id
    );
}


// Lukker database forbindelsen
$conn->close();

// Print the updated dishes_per_day array
print_r($list_of_dishes_per_day);
echo "<br>";
echo "<br>";
print_r($list_of_used_recipes_for_breakfast);
echo "<br>";
print_r($list_of_used_recipes_for_lunch);
echo "<br>";
print_r($list_of_used_recipes_for_dinner);