<?php
include_once('../util/crud.php');
session_start();

require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id'])) {
        deleteRecord($conn, 'meals', $_POST['id']);
        mysqli_close($conn);
      }
    header('Location: ../pages/admin.php');
    exit();
  }
      

