<?php
function createRecord($conn, $tableName, $data) {
    $columns = implode(', ', array_keys($data));
    $values = implode(', ', array_map(function($value) use ($conn) {
      return is_string($value) ? "'" . mysqli_real_escape_string($conn, $value) . "'" : $value;
    }, array_values($data)));
    $query = "INSERT INTO `$tableName` ($columns) VALUES ($values)";
    return mysqli_query($conn, $query);
  }
  
  function readRecord($conn, $tableName, $data) {
    $where = implode(' AND ', array_map(function($key) use ($data) {
      $value = is_string($data[$key]) ? "'$data[$key]'" : $data[$key];
      return "$key = $value";
    }, array_keys($data)));
    $query = "SELECT * FROM $tableName WHERE $where";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
  }
  
  function updateRecord($conn, $tableName, $id, $data) {
    $escapedData = array_map(function($value) use ($conn) {
      return is_string($value) ? mysqli_real_escape_string($conn, $value) : $value;
    }, $data);
    
    $set = implode(', ', array_map(function($key) use ($escapedData) {
      $value = is_string($escapedData[$key]) ? "'$escapedData[$key]'" : $escapedData[$key];
      return "$key = $value";
    }, array_keys($escapedData)));
    
    $query = "UPDATE $tableName SET $set WHERE id = $id";
    return mysqli_query($conn, $query);
  }
  
  function deleteRecord($conn, $tableName, $id) {
    $query = "DELETE FROM $tableName WHERE id = $id";
    return mysqli_query($conn, $query);
  }

  ?>