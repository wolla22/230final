<!doctype html>
<html lang="en">
<head>
    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<?php include("../injections/bootstrap.html"); ?>


  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <title>Admin Page</title>
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

<h3>Your Restaurants</h3>
<?php
// Connect to the database
require('../util/db.php');
include_once('../util/adminhelp.php');
$conn = connectDB("../config/connection-details.txt");
$restaurants = listRestaurantsByUserID($conn, 'restaurants', $_SESSION['id']);
?>
<?php foreach ($restaurants as $restaurant) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="card">
            <h3 class="card-title"><?php echo $restaurant['name']; ?></h3>
            <h4 class="card-subtitle"><?php echo $restaurant['categ']; ?></h4>
            <p class="card-text"><?php echo $restaurant['descript']; ?></p>
            <p class="card-text">ID: <?php echo $restaurant['ID']; ?></p>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Current Orders:</h5>
              <?php
                // Retrieve the orders for this restaurant
                $orders = listOrdersByRestaurantID($conn, 'orders', $restaurant['ID']);
              ?>
              <?php if (empty($orders)) { ?>
                <p>No current orders for this restaurant.</p>
              <?php } else { ?>
                <ul>
                <?php foreach ($orders as $order) { 
                  $meal = readRecord($conn, "meals", ["ID" => $order['meal_id']]);
                  $mealName = $meal["name"];
                ?>
                <div class="card-body">
                  <p>Meal: <?php echo $meal['name']; ?></p>
                  <p>Address: <?php echo $order['address']; ?></p>
                  <p>Time: <?php echo $order['time']; ?></p>
                  <p>Status: <?php echo $order['status']; ?></p>
                  <button data-toggle="modal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderModal">
                    Change Status
                  </button>
      
                  <!-- Modal -->
                  <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="orderModalLabel">Change Order Status</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="../forms/update-order-status.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order['ID']; ?>">
                            <div class="form-group">
                              <label for="status">New Status:</label>
                              <select class="form-control" id="status" name="status">
                                <option value="Ordered">Ordered</option>
                                <option value="Delivering">Delivering</option>
                                <option value="Delivered">Delivered</option>
                              </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
                </ul>
              <?php } ?>
            </div>
          </div>
          <h5 class="card-title">Meals:</h5>
          <ul>
          <?php foreach ($restaurant['meals'] as $meal) { ?>
            <li>
              
              <form action="../forms/modify-meal.php" method="POST">
                
                <?php echo $meal['name']; ?>
                <input type="hidden" name="meal_id" value="<?php echo $meal['ID']; ?>">
                <input type="text" name="name" value="<?php echo $meal['name']; ?>">
                <input type="text" name="descript" value="<?php echo $meal['descript']; ?>">
                <input type="submit" value="Modify">
              </form>
              <form action="../forms/delete-meal.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $meal['ID']; ?>">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
          <?php } ?>
          <h3>Create New Meal</h3>
            <form action="../forms/create-meal.php" method="POST">
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="descript" name="descript"></textarea>
              </div>
              <div class="form-group">
                <input type="hidden" id="rest_id" name="rest_id" value="<?php echo $restaurant['ID']; ?>">
              </div>
              <input type="submit" class="btn btn-primary" value="Submit">
            </form>
          <?php}?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <hr>
<?php } ?>
<h3>Add Restaurant</h3>
    <form action="../forms/newrest_form.php" method="POST">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <input type="hidden" id="id" name="id" value=<?php echo $_SESSION['id'] ?>>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description"></textarea>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <input type="text" class="form-control" id="category" name="category">
      </div>
      <input type="submit" class="btn btn-primary" value="Submit">
    </form>
    <h3>Modify Restaurant</h3>
    <form action="../forms/modrest_form.php" method="POST">
    <p>(The restaurant ID must be inputted to determine which restaurant to modify!)</p>
      <div class="form-group">
        <label for="rest_id">ID:</label>
        <input type="text" class="form-control" name="rest_id" id="rest_id" required>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" id="name" required>
        <input type="hidden" class="form-control" name="user_id" id="user_id" value=<?php echo $_SESSION['id']; ?>>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <input type="text" class="form-control" name="category" id="category" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" id="description"></textarea>
      </div>
      <input type="submit" class="btn btn-primary" value="Update restaurant">
    </form>
    <h3>Delete Restaurant</h3>
    <form action="../forms/delrest_form.php" method="post">
      <div class="form-group">
        <label for="restaurant_id" class="form-label">Enter the ID of the restaurant you want to delete:</label>
        <p>(All meals associated with the restaurant must be deleted first!)</p>
        <input type="text" id="restaurant_id" name="restaurant_id" class="form-control">
      </div>
      <input type="submit" value="Delete Restaurant" class="btn btn-primary">
    </form>
</body>



