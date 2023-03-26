<?php
session_start();

require_once __DIR__ . "/../database/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $telephone = $_POST['telephone'];
    $entreprise = $_POST['entreprise'];

    $sql = "INSERT INTO users (nom, prenom, email, password, telephone, entreprise) VALUES ('$nom', '$prenom', '$email', '$password', '$telephone', '$entreprise')";
    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['message'] = "Felicitation pour votre inscription, checkez vos mails et cliquez sur le lien afin de valider votre inscription !";
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
