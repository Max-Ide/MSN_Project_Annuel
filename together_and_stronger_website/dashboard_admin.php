<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/epq7mib.css">
</head>
<body>
    <div class="admin-dashboard">
        <div class="sidebar-admin">
            <div class="logo-dashboard">
                <h1 class="logo-db"><a href="index.php" class="logo-link">Together & Stronger</a></h1>
            </div>
            <button class="sidebar-admin-btn" id="admin-info-btn">Dashboard</button>
            <button class="sidebar-admin-btn" id="manage-activities-btn">Gestion des activités</button>
            <button class="sidebar-admin-btn" id="manage-clients-btn">Gestion des clients</button>
            <button class="sidebar-admin-btn" id="manage-users-btn">Gestion des utilisateurs</button>

            <div class="spacer-admin"></div>
            <button class="sidebar-admin-btn" id="admin-logout-btn" onclick="window.location.href='index.php';">Se déconnecter</button>
        </div>
        <div class="content-ad">
            <div id="admin-info" class="content-section">
                <!-- Admin information will be displayed here -->
            </div>
            <div id="manage-activities" class="content-section">
                <?php include "show_activities.php"; ?>
                <button id="add-activity">Add Activity</button>
            </div>
            <div id="manage-clients" class="content-section">
                <!-- User management will be displayed here -->
            </div>
            <div id="manage-users" class="content-section">
                <!-- User management will be displayed here -->
            </div>
        </div>
    </div>
    <script src="scripts/adminDashboard.js"></script>
</body>
</html>