<!doctype html>
<html lang="en">
<head>
    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include("../injections/bootstrap.html"); ?>
    <title>ToFoo</title>
    <style>
        <?php include("../injections/css.html"); ?>
    </style>
</head>
<body>
    <?php
        //import and include resources needed for functions and file manipulation
        session_start();
        require('../util/crud.php');
        include("../injections/nav.php");
    ?>
    <?php
    require('../util/db.php');
    $conn = connectDB("../config/connection-details.txt");
    // Check if a restaurant ID was provided
    if (isset($_GET['restaurant_id'])) {
    $restaurantId = intval($_GET['restaurant_id']);
    // Read the restaurant record from the "restaurants" table
    $restaurant = readRecord($conn, 'restaurants', ['ID' => $restaurantId]);
        // Print the restaurant's information
        echo "<h1>{$restaurant['name']}</h1>";
        echo "<p>Category: {$restaurant['categ']}</p>";
        echo "<p>Description: {$restaurant['descript']}</p>";
        // Read all meal records from the "meals" table for the given restaurant
        $mealsWhere = "rest_id = $restaurantId";
        $mealResult = mysqli_query($conn, "SELECT * FROM meals WHERE $mealsWhere");
        $meals = mysqli_fetch_all($mealResult, MYSQLI_ASSOC);

        if ($meals) {
            foreach ($meals as $meal) {
                echo "<h3>{$meal['name']}</h3>";
                echo "<p>{$meal['descript']}</p>";
                if (isset($_SESSION['type'])) {
                    // Check if the session value for "type" is "admin"
                    if ($_SESSION['type'] === 'user') { ?>
                        <button type="submit" name="submit" id="button">Order</button>
                        <form action="../forms/neword_form.php" id="form" style="display: none;" method="POST">
                        <input type="hidden" id="status" name="status" value="<?php echo "Ordered"; ?>"><br>
                            <input type="hidden" id="rest_id" name="rest_id"value="<?php echo $_GET['restaurant_id']; ?>"><br>
                            <input type="hidden" id="meal_id" name="meal_id" value="<?php echo $meal['ID']; ?>"><br>
                            <label for="address">Email:</label><br>
                            <input type="text" id="email" name="email"><br>
                            <label for="address">Address:</label><br>
                            <textarea id="address" name="address" rows="5" cols="40"></textarea><br>
                            <input type="hidden" id="time" name="time" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <input type="submit" value="Submit">
                        </form>
                    <?php } ?>
                <?php }
            }
        }
    }
    mysqli_close($conn); ?>
    
    <script>
    // get the button and form elements
    var button = document.getElementById('button');
    var form = document.getElementById('form');

    // add an event listener for the button click
    button.addEventListener('click', function() {
        // show the form as a popup
        form.style.display = 'block';
    });
</script>






