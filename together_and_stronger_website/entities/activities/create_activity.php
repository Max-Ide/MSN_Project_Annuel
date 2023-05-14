<?php
require_once __DIR__ . "/../../database/connection.php";

$response = array();

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['image_url']) && isset($_POST['duration']) && isset($_POST['min_participants']) && isset($_POST['max_participants']) && isset($_POST['price_per_participants']) && isset($_POST['location_id']) ) {
    $activity_nom = $_POST['name'];
    $activity_description = $_POST['description'];
    $activity_image = $_POST['image_url'];
    $activity_duree = $_POST['duration'];
    $activity_min_participants = $_POST['min_participants'];
    $activity_max_participants = $_POST['max_participants'];
    $activity_prix = $_POST['price_per_participants'];
    $activity_localisation = $_POST['location_id'];

    $sql = "INSERT INTO activities (name, description, image_url, duration, min_participants, max_participants, price_per_participants, location_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiiii", $activity_nom, $activity_description, $activity_image, $activity_duree, $activity_min_participants, $activity_max_participants, $activity_prix, $activity_localisation);

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "L'activité a été ajoutée avec succès.");
    } else {
        $response = array("status" => "error", "message" => "Erreur lors de l'ajout de l'activité.");
    }

    $stmt->close();
} else {
    $response = array("status" => "error", "message" => "Informations insuffisantes pour ajouter l'activité.");
}

$conn->close();
echo json_encode($response);
?>