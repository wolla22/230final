<?php
include_once("../util/crud.php");
session_start();

require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");

$restaurant_id = $_POST['restaurant_id'];
$tableName = 'restaurants';
$result = deleteRecord($conn, $tableName, $restaurant_id);


header('Location: ../pages/admin.php');
exit();

mysqli_close($conn);