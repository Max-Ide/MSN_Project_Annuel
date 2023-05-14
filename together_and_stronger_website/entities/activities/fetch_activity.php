<?php
require_once __DIR__ . "/../../database/connection.php";

$sql = "SELECT * FROM activities";
$result = $conn->query($sql);
$activities = array();

while ($row = $result->fetch_assoc()) {
    $activities[] = $row;
}

$conn->close();
?>