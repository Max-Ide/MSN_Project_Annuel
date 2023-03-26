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
<?php 
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>
<header>
    <div class="header-container">
        <div class="header-content">
            <h1 class="logo">Together & Stronger</h1>
            <div class="auth-buttons">
                <button class="login-button" onclick="window.location.href='connection.php';">Se connecter</button>
                <button class="signup-button" onclick="window.location.href='inscription.php';">S'inscrire</button>
            </div>
        </div>
    </div>
</header>

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

<footer>
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-logo">
                <h3>Together & Stronger</h3>
            </div>
            <nav class="footer-nav">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="">Notre histoire</a></li>
                    <li><a href="#">Activités</a></li>
                    <li><a href="#">Lieux</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="footer-lang">
                <ul>
                    <li><a href="#"><i class="fa fa-flag"></i> FR</a></li>
                    <li><a href="#"><i class="fa fa-flag"></i> EN</a></li>
                    <li><a href="#"><i class="fa fa-flag"></i> ES</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Tous droits réservés © 2023 Together & Stronger</p>
        </div>
    </div>
</footer>


</body>
</html>