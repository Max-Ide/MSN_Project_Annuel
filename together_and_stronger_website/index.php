<?php
// Récupérez l'URL demandée
$url = $_GET['url'];

// Définissez les routes
$routes = [
    'database' => 'database',
    'entities' => 'entities',
    'images' => 'images',
    'includes' => 'includes',
    'styles' => 'styles',
    'user' => 'user',
    'vendor' => 'vendor',
    'activities.php' => 'activities',
    'index.php' => 'index',
    'inscription.php' => 'inscription',
    'verif_email.php' => 'verif_email'
];


// Parcourez les routes pour trouver celle qui correspond à l'URL
foreach ($routes as $pattern => $controller) {
    if ($pattern === $url || preg_match('#^'.$pattern.'$#', $url, $params)) {
        // Si une route correspond, incluez le contrôleur correspondant
        include_once 'controllers/'.$controller.'.php';
        // Appelez la fonction correspondante en passant les paramètres capturés
        call_user_func_array($controller, array_slice($params, 1));
        // Sortez de la boucle
        break;
    }
}


