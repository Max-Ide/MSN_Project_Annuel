<header>
    <div class="header-container">
        <div class="header-content">
            <h1 class="logo"><a href="index.php" class="logo-link">Together & Stronger</a></h1>
            <?php
            session_start(); 

            if (isset($_SESSION['email'])):
            ?>
                <div class="burger-menu">
                    <button class="burger-button" onclick="toggleMenu();">
                    </button>
                    <div id="menu" class="menu-content" style="display: none;">
                        <a href=".php">Mon compte</a>
                        <a href="activities.php">Activités</a>
                        <a href="card.php">Mon panier</a>
                        <a href="deconnection.php">Se déconnecter</a>
                    </div>
                </div>
            <?php
            else:
            ?>
                <div class="auth-buttons">
                    <button class="login-button" onclick="window.location.href='connection.php';">Se connecter</button>
                    <button class="signup-button" onclick="window.location.href='inscription.php';">S'inscrire</button>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</header>