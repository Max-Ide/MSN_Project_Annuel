<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "entities/users/create_user.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/epq7mib.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
    <div class="signup-container">
        <div class="form-container">
            <h2>Inscrivez-vous</h2>
            <form action="entities/users/create_user.php" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="prenom">Prénom</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                <span class="error" id="passwordError"></span>

                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" required>
                <span class="error" id="phoneError"></span>

                <label for="entreprise">Entreprise</label>
                <input type="text" id="name_company" name="name_company" required>

                <button type="submit" class="rounded-button">S'inscrire</button>
            </form>
            <p>Êtes-vous une entreprise ?</p>
            <button onclick="window.location.href='inscription_entreprise.php'" class="rounded-button">Inscription Entreprise</button>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="js/champsValidation.js"></script>

</body>
</html>
