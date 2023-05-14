<?php
session_start();
require_once __DIR__ . "/entities/activities/fetch_activity.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Activités</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/epq7mib.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="main-activities">
    <div class="act-container">
        <h1 class="catalogue-title">Activités</h1>
        <p class="catalogue-phrase">Découvrez nos activités</p>
    </div>
    <hr class="catalogue-line">
    <div class="activities-grid" id="activities-grid">
    <?php if (isset($activities) && !empty($activities)): ?>
        <?php foreach ($activities as $activity): ?>
            <div class="activity-item">
                <img src="<?php echo $activity['image_url']; ?>" alt="Activity Image">
                <h3 class="activity-name"><?php echo $activity['name']; ?></h3>
                <button class="discover-btn" data-id="<?php echo $activity['id']; ?>" onclick="viewActivity(this);">Voir l'activité</button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune activité n'a été trouvée.</p>
    <?php endif; ?>
    </div>   
</main>

<?php include 'includes/footer.php'; ?>

<script src="js/viewActivity.js"></script>
<script src="js/burgerMenuHeader.js"></script>
</body>
</html>