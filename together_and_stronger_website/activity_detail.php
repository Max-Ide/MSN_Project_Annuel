<?php
require_once __DIR__ . "/database/connection.php";

$id = $_GET['id'];

$sql = "SELECT * FROM activities WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$activity = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $activity['name'] ?></title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/epq7mib.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
  <div class="activity-detail">
    <div class="activity-image">
      <img src="<?= $activity['image_url_detail'] ?>" alt="<?= $activity['name'] ?>">
      <div class="activity-duration">Durée : <?= $activity['duration'] ?> minutes</div>
    </div>
    <div class="activity-description">
      Description : <?= $activity['description'] ?>
    </div>
    <div class="activity-info">
      <div class="activity-price">
        Prix par participants : <?= $activity['price_per_participants'] ?>
      </div>
      <div class="activity-participants">
        Nombre de participants : <?= $activity['min_participants'] ?> - <?= $activity['max_participants'] ?>
      </div>
      <a href="booking_page.php?id=<?= $activity['id'] ?>" class="booking-btn">Réserver</a>
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="js/burgerMenuHeader.js"></script>
</body>
</html>