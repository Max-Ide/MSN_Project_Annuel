<?php
require_once __DIR__ . "/database/connection.php";

$userId = $_POST['id'];

$sql = "UPDATE users SET is_banned = 0 WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->close();

echo "Utilisateur débanni avec succès.";
?>