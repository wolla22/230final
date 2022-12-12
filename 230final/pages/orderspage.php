
<!DOCTYPE html>
<html>
<head>
<?php include("../injections/bootstrap.html"); ?>
<style>
     <?php include("../injections/css.html"); ?>
    </style>
  <title>Your Orders</title>
</head>
<?php
session_start();
include_once('../util/crud.php');
include_once('../util/db.php');
$conn = connectDB("../config/connection-details.txt");
// Check if the session value for "email" is set
if (isset($_SESSION['email'])) {
  // Retrieve the rows of the "orders" table where the email matches the provided email
  $query = "SELECT * FROM orders WHERE email = '{$_SESSION['email']}'";
  $result = mysqli_query($conn, $query);
  $orders = [];

  // Loop through each row of the result
  while ($row = mysqli_fetch_assoc($result)) {
    // Add the order to the array
    $orders[] = $row;
  }
} else {
  // Redirect to the signin page
  header('Location: auth/signup.php');
  exit();
}
?>
<body>
    <?php 
      //Navigation bar
      include("../injections/nav.php");
    ?>
  <h1>Your Orders</h1>
  <?php 
  //List orders associated with the user's "ID" value
  foreach ($orders as $order) { 
    $restaurant = readRecord($conn, "restaurants", ["ID" => $order['rest_id']]);
    $meal = readRecord($conn, "meals", ["ID" => $order['meal_id']]);
    $restaurantName = $restaurant["name"];
    $mealName = $meal["name"];?>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title"><?php echo $restaurantName; ?></h3>
            <h4 class="card-subtitle"><?php echo $mealName; ?></h4>
            <p class="card-text"><?php echo $order['address']; ?></p>
            <p class="card-text"><?php echo $order['time']; ?></p>
            <p class="card-text"><?php echo $order['status']; ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</body>
</html>
