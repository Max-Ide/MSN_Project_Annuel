<?php
session_start();
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
    <div class="activities-grid">
        <div class="activity-item">
            <img src="images/rando.jpg" alt="Activity Image">
            <h3 class="activity-name">Randonnée</h3>
               <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/cocktail.jpg" alt="Activity Image">
            <h3 class="activity-name">Soirée Cocktail</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/sculpting.jpg" alt="Activity Image">
            <h3 class="activity-name">Atelier Sculpture</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/babyfoot.jpg" alt="Activity Image">
            <h3 class="activity-name">Baby-foot</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/pingpong3.jpg" alt="Activity Image">
            <h3 class="activity-name">Tennis de table</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/painting.jpg" alt="Activity Image">
            <h3 class="activity-name">Création artistique</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/travel.jpg" alt="Activity Image">
            <h3 class="activity-name">Voyage</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/vr.jpg" alt="Activity Image">
            <h3 class="activity-name">Activité Réalité Virtuelle</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/actculinaire2.jpg" alt="Activity Image">
            <h3 class="activity-name">Atelier Culinaire</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/boardgame.jpg" alt="Activity Image">
            <h3 class="activity-name">Jeux de société</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/karaoke.jpg" alt="Activity Image">
            <h3 class="activity-name">Karaoké</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
        <div class="activity-item">
            <img src="images/charity2.jpg" alt="Activity Image">
            <h3 class="activity-name">Évenement caritatif</h3>
            <button class="discover-btn">Voir l'activité</button>
        </div>
    </div>   
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>