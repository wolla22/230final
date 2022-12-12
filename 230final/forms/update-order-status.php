<?php
session_start();

require('../util/crud.php');

require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");
$orderID = $_POST['order_id'];
$status = $_POST['status'];

$data = [
  'status' => $status
];
updateRecord($conn, 'orders', $orderID, $data);

header('Location: ../pages/admin.php');
exit();
?>


