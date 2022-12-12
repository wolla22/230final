<?php

require_once '../util/crud.php';
session_start();

require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $descript = isset($_POST['descript']) ? $_POST['descript'] : '';
  $rest_id = isset($_POST['rest_id']) ? (int)$_POST['rest_id'] : 0;
  
  if (empty($name) || empty($descript) || empty($rest_id)) {
    echo 'Please enter a name, description, and restaurant ID for the meal.';
  } else {
    $success = createRecord($conn, 'meals', [
      'name' => $name,
      'descript' => $descript,
      'rest_id' => $rest_id
    ]);
    header('Location: ../pages/admin.php');
    exit();
}
}