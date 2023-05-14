<?php
require_once __DIR__ . "/../../database/connection.php";

if (isset($_GET['activity_id'])) {
    $activity_id = $_GET['activity_id'];

    $sql = "SELECT * FROM activities WHERE activity_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $activity_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
?>
            <form id="edit-activity-form">
                <input type="hidden" name="activity_id" value="<?= $row['activity_id'] ?>">
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                </div>
                <div>
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" rows="4" cols="50" required><?= htmlspecialchars($row['description']) ?></textarea>
                </div>
                <div>
                    <label for="price_per_participants">Prix par participants :</label>
                    <input type="number" id="price_per_participants" name="price_per_participants" value="<?= $row['price_per_participants'] ?>" required>
                </div>
                <button type="submit">Mettre à jour l'activité</button>
            </form>
<?php
        }
    } else {
        echo "Erreur lors de la récupération de l'activité.";
    }

    $stmt->close();
} else {
    echo "Aucun ID d'activité fourni.";
}

$conn->close();
?>
