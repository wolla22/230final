<?php
    include_once("../util/crud.php");
    session_start();

  if (isset($_POST)) {
    $email = $_POST['email'];
    $rest_id = $_POST['rest_id'];
    $meal_id = $_POST['meal_id'];
    $address = $_POST['address'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    require('../util/db.php');
    $conn = connectDB("../config/connection-details.txt");
    $data = array(
      'email' => $email,
      'rest_id' => $rest_id,
      'meal_id' => $meal_id,
      'address' => $address,
      'time' => $time,
      'status' => $status,
    );


    $result = createRecord($conn, 'orders', $data);

    header('Location: ../pages/orderspage.php');
    exit();
  }

?>