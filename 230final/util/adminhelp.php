<?php 
function listRestaurantsByUserID($conn, $tableName, $userID) {
    // Retrieve the rows of the "restaurants" table where the user_id matches the provided userID
    $query = "SELECT * FROM $tableName WHERE user_id = $userID";
    $result = mysqli_query($conn, $query);
    
    // Create an empty array to store the restaurants
    $restaurants = [];
    
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
  
      // Retrieve the meals for this restaurant
      $meals = listMealsByRestaurantID($conn, 'meals', $row['ID']);
      
      // Add the meals to the restaurant
      $row['meals'] = $meals;
      $restaurants[] = $row;
    }
    
    // Return the array of restaurants
    return $restaurants;
  }
    function listMealsByRestaurantID($conn, $tableName, $restaurantID) {
      // Retrieve the rows of the "meals" table where the rest_id matches the provided restaurantID
      $query = "SELECT * FROM $tableName WHERE rest_id = $restaurantID";
      $result = mysqli_query($conn, $query);
      
      // Create an empty array to store the meals
      $meals = [];
      
      // Loop through each row of the result
      while ($row = mysqli_fetch_assoc($result)) {
        // Add the meal to the array
        $meals[] = $row;
      }
      
      // Return the array of meals
      return $meals;
  }
  function listOrdersByRestaurantID($conn, $tableName, $restaurantID) {
    // Retrieve the rows of the "orders" table where the rest_id matches the provided restaurantID
    $query = "SELECT * FROM $tableName WHERE rest_id = $restaurantID";
    $result = mysqli_query($conn, $query);
    
    // Create an empty array to store the orders
    $orders = [];
    
    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
      // Add the order to the array
      $orders[] = $row;
    }
    
    // Return the array of orders
    return $orders;
  }