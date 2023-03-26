<?php
include_once __DIR__ . "/config.php";

$conn = new mysqli($databaseHostName, $databaseUsername, $databasePassword, $databaseName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
