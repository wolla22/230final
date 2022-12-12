<?php
  function connectDB($filename) {
    $fileContent = file_get_contents($filename);
    if ($fileContent === false) {
      return "Error: Could not read the file $filename";
    }

    $data = explode(',', $fileContent);
    if (count($data) !== 4) {
      return "Error: Invalid data in file $filename";
    }

    $host = $data[0];
    $username = $data[1];
    $password = $data[2];
    $database = $data[3];

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
      return "Error: Could not connect to the database using the provided data";
    }
    return $conn;
  }

function connectToPDO($filename) {
  $data = file_get_contents($filename);
  list($host, $username, $password, $database) = explode(',', $data);

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    return $pdo;
  } catch (PDOException $e) {
    return $e->getMessage();
  }
}
