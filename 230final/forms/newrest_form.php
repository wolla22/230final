<?php
include_once("../util/crud.php");
session_start();
require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");

$name = $_POST['name'];
$id = $_POST['id'];
$description = $_POST['description'];
$category = $_POST['category'];

$name = trim($name);
$description = trim($description);
$category = trim($category);

$tableName = 'restaurants';
$data = [
  'name' => $name,
  'user_id' => $id,
  'categ' => $category,
  'descript' => $description
];
$result = createRecord($conn, $tableName, $data);

header('Location: ../pages/admin.php');
exit();

mysqli_close($conn);