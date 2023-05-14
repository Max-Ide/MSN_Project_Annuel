<?php
require_once __DIR__ . "/../../database/connection.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');

$response = array();

if (isset($_POST['activity_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price_per_participants'])) {
    $activity_id = $_POST['activity_id'];
    $activity_nom = $_POST['name'];
    $activity_description = $_POST['description'];
    $activity_price = $_POST['price_per_participants'];

    $sql = "UPDATE activities SET name = ?, description = ?, price_per_participants = ? WHERE activity_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $activity_nom, $activity_description, $activity_price, $activity_id);

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "L'activité a été mise à jour avec succès.");
    } else {
        $response = array("status" => "error", "message" => "Erreur lors de la mise à jour de l'activité.");
    }

    $stmt->close();
} else {
    $response = array("status" => "error", "message" => "Informations insuffisantes pour mettre à jour l'activité.");
}

$conn->close();
echo json_encode($response);
?>
