<?php
include_once('../util/crud.php');
session_start();

require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateRecord($conn, 'meals', $_POST['meal_id'], [
      'name' => $_POST['name'],
      'descript' => $_POST['descript'],
    ]);
    
    header('Location: ../pages/admin.php');
    exit();
  }