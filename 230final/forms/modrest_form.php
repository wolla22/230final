<?php
include_once("../util/crud.php");
session_start();
require('../util/db.php');
$conn = connectDB("../config/connection-details.txt");

$id = $_POST['rest_id'];
$name = $_POST['name'];
$user_id = $_POST['user_id'];
$category = $_POST['category'];
$description = $_POST['description'];

$name = trim($name);
$description = trim($description);
$category = trim($category);

$tableName = 'restaurants';
$data = [
    'id'=> $id,
    'name' => $name,
    'user_id' => $user_id,
    'categ' => $category,
    'descript' => $description,
];
$result = updateRecord($conn, $tableName, $id, $data);

header('Location: ../pages/admin.php');
    exit();

mysqli_close($conn);