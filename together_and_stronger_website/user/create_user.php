<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../database/connection.php";

$error_messages = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone'];
    $entreprise = $_POST['entreprise'];
    $cle = uniqid();

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_messages['email'] = 'L\'adresse e-mail n\'est pas valide.';
    } else {
        // Check if email already exists
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_messages['email'] = 'L\'adresse e-mail existe déjà.';
        }
    }

    // Validate password
    if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password)) {
        $error_messages['password'] = 'Le mot de passe doit contenir au moins 6 caractères, dont au moins une lettre majuscule et un chiffre.';
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // Validate telephone
    if (!preg_match('/^\d{10}$/', $telephone)) {
        $error_messages['telephone'] = 'Le numéro de téléphone doit contenir exactement 10 chiffres.';
    }

    // If there are no error messages, insert the data into the database and send the confirmation email
    if (empty($error_messages)) {
        $sql = "INSERT INTO users (nom, prenom, email, password, telephone, entreprise, cle) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $nom, $prenom, $email, $password, $telephone, $entreprise, $cle);
        $stmt->execute();

        // Send the confirmation email
        // ...
    }
}

if($_POST){
    function smtpmailer($to, $from, $from_name, $subject, $body){
        $mail = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'togetherandstronger.pa@gmail.com';
            $mail->Password   = 'ynpedgiteewrutgr';
            $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
            $mail->Port       = 587;
        
            $mail->setFrom($from, $from_name);
            $mail->addAddress($to);
        
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
        
            $mail->send();
            return "Message has been sent";
        } catch (Exception $e) {
          return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
       }
    }
        
    $to   = $_POST['email'];
    $from = 'togetherandstronger.pa@gmail.com';
    $name = 'Together & Stronger';
    $subj = 'Confirmation de compte - Together & Stronger';
    $msg = '<h2>Bienvenue : ' . $_POST['prenom'] . ' !</h2>' . '<br /> <p>Pour confirmer votre inscription, il vous suffit de cliquer <a href="http://localhost:8888/test/verif_mail.php?cle=' . $cle . '">ICI</a><br />';

    $error=smtpmailer($to,$from, $name ,$subj, $msg);

    header('location:../index.php?validateMSG=Compte crée avec succès ! Un email de confirmation vous a été envoyé !');
    exit;
}

$conn->close();
?>
