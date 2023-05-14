<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
}

if (empty($_POST['email']) || empty($_POST['password'])) {
    header('location: connection.php?message=Vous devez remplir les 2 champs.');
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: connection.php?message=Email invalide.');
    exit;
}

require_once __DIR__ . "/database/connection.php";

$query = $conn->prepare('SELECT firstname, lastname, password, is_banned FROM employees WHERE email= ?');
$query->bind_param('s', $_POST['email']);
$query->execute();
$results = $query->get_result();

if ($results->num_rows == 0) {
    header('location: connection.php?message=Identifiants incorrects.');
    exit;
}

$user = $results->fetch_assoc();

if ($user['is_banned'] == 1) {
    header('location: index.php?message=Vous êtes banni.');
    exit;
}

if (!password_verify($_POST['password'], $user['password'])) {
    header('location: connection.php?message=Identifiants incorrects.');
    exit;
}

session_start();

$_SESSION['email'] = $_POST['email'];
$_SESSION['lastname'] = $user['lastname'];
$_SESSION['firstname'] = $user['firstname'];

$q = 'SELECT id_company, is_admin FROM employees WHERE email=?';
$stmt = $conn->prepare($q);
$stmt->bind_param('s', $_POST['email']);
$stmt->execute();
$pass = $stmt->get_result()->fetch_assoc();
$_SESSION['id_company'] = $pass['id_company'];

if ($pass['is_admin'] == 1) {
    header('location: dashboard_admin.php');
    exit;
}

header('location: index.php');
exit;
?>