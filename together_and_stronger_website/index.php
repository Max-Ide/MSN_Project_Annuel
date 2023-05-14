<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/epq7mib.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
    <div class="main-container">
        <h2>
            <span>Bienvenue chez</span>
            <span>Together & Stronger</span>
        </h2>
        <p class="slogan">Construisons ensemble une equipe plus forte chez nous</p>
        <div class="cta-wrapper">
            <div class="cta-button-wrapper">
                <a href="activities.php" class="cta-button">Decouvrir nos activites</a>
            </div>
            <div class="images-wrapper">
                <img src="images/image1.jpg" alt="image1" class="image1">
                <img src="images/image2.jpg" alt="image2" class="image2">
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="js/burgerMenuHeader.js"></script>
</body>
</html>