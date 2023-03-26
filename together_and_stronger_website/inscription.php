<?php
require_once "entities/create_user.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/epq7mib.css">
</head>
<body>
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
    <div class="signup-container">
        <div class="form-container">
            <h2>Inscrivez-vous</h2>
            <form action="entities/create_user.php" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>

                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" required>

                <label for="entreprise">Entreprise</label>
                <input type="text" id="entreprise" name="entreprise" required>

                <button type="submit" class="rounded-button">S'inscrire</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>