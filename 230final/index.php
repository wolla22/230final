<!doctype html>
<html lang="en">
<head>
    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include("injections/bootstrap.html"); ?>
    <title>ToFoo</title>
  <style>
    <?php 
      include("injections/css.html"); 
    ?>
  </style>
</head>
<body>
  <?php 
    session_start(); 
    require('util/crud.php');
    require('util/db.php');
  //Navigation bar for home screen
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Food Ordering System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <?php 
          if (isset($_SESSION['logged'])) { ?>
          <li class="nav-item">
              <a href="auth/signout.php" class="nav-link">Sign Out</a>
          </li>
              <?php } else { ?>
            <li class="nav-item">
              <a href="auth/signup.php" class="nav-link">Sign Up</a>
            </li>
              <li class="nav-item">  
              <a href="auth/signin.php" class="nav-link">Sign In</a>
            </li>
          <?php } 
          if (isset($_SESSION['type'])) {?>
            <?php if ($_SESSION['type']=="admin") {?>
              <li class="nav-item">
                <a href="pages/admin.php" class="nav-link">Admin Page</a>
              </li>
                <?php } else if ($_SESSION['type']=="user") { ?>
              <li class="nav-item">
                <a href="pages/orderspage.php" class="nav-link">Your Orders</a>
              </li>
            <?php } 
          }?>
      </ul>
    </div>
  </nav>
    <?php
      // Connect to the database
      $conn = connectDB("config/connection-details.txt");
      // Retrieve the categories
      $categories = ["American", "Italian", "Vegetarian"];   
      // Read the rows of the "restaurants" table
      $tableName = 'restaurants';
    ?>
    <h5 class="card-title">Categories</h5>
    <?php foreach ($categories as $category) { ?>
      <h2><?php print($category); ?></h2>
      <div class="card-deck">
        <?php $result = mysqli_query($conn, "SELECT * FROM $tableName"); ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <?php if ($row["categ"] == $category) { ?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p class="card-text"><?php echo $row['descript']; ?></p>
                <a href="pages/profile.php?restaurant_id=<?php echo $row['ID']; ?>" class="btn btn-primary">View Details</a>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    <?php } 
      // Query the database to retrieve the list of restaurants
      $query = "SELECT * FROM restaurants";
      $result = mysqli_query($conn, $query);
      ?>
      <h5 class="card-title">All Restaurants</h5>
      <div class="card-deck">
        <?php
          // Loop through the result set and print the name of each restaurant
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
              <div class="card-body">
              <h5 class="card-title"><?php echo $row['name'] . "<br />"; ?></h5>
              <p class="card-text"><?php echo $row['descript']; ?></p>
              <a href="pages/profile.php?restaurant_id=<?php echo $row['ID']; ?>" class="btn btn-primary">View Details</a>
              </div>
            </div>
            <?php } ?>
      </div> 
    <?php mysqli_close($conn); ?>
    </body>
</html>