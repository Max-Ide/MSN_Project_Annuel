<?php
require_once __DIR__ . "/../../database/connection.php";

$response = array();

if (isset($_POST['activity_id'])) {
    $activity_id = $_POST['activity_id'];
    
    $sql = "DELETE FROM activities WHERE activity_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $activity_id);

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "L'activité a été supprimée avec succès.");
    } else {
        $response = array("status" => "error", "message" => "Erreur lors de la suppression de l'activité.");
    }

    $stmt->close();
} else {
    $response = array("status" => "error", "message" => "Aucun ID d'activité fourni.");
}

$conn->close();
echo json_encode($response);
?>