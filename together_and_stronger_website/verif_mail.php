<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('database/connection.php');

if (!isset($_GET['cle']) && empty($_GET['cle'])) {
    header('location:index.php');
    exit;
}
$cle = $_GET['cle'];

$q = 'SELECT id FROM users WHERE cle = ?';
$stmt = $conn->prepare($q);

if ($stmt === false) {
    printf("Error: %s\n", $conn->error);
    exit;
}

$stmt->bind_param("s", $cle);
$stmt->execute();
$result = $stmt->get_result();
$user_infos = $result->fetch_assoc();
$stmt->close();

if ($result->num_rows > 0) {
    $q = 'UPDATE users SET is_verified = true WHERE id = ?';
    $stmt = $conn->prepare($q);

    if ($stmt === false) {
        printf("Error: %s\n", $conn->error);
        exit;
    }

    $stmt->bind_param("i", $user_infos['id']);
    $stmt->execute();
    header('location:index.php');
    exit;
} else {
    echo 'Verification invalide ! ';
}
?>
