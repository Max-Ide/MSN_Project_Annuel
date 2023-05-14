<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../../database/connection.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['lastname'];
    $prenom = $_POST['firstname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $telephone = $_POST['telephone'];
    $entreprise = $_POST['name_company'];
    $cle = uniqid();

    $sql = "INSERT INTO employees (lastname, firstname, email, password, telephone, company_name, cle) VALUES ('$nom', '$prenom', '$email', '$password', '$telephone', $entreprise, '$cle')";
    $result = $conn->query($sql);
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
    $msg = '<h2>Bienvenue : ' . $_POST['firstname'] . ' !</h2>' . '<br /> <p>Pour confirmer votre inscription, il vous suffit de cliquer <a href="https://togetherandstronger.website/verif_mail.php?cle=' . $cle . '">ICI</a><br />';

    $error=smtpmailer($to,$from, $name ,$subj, $msg);

    header('location:../../index.php?validateMSG=Compte crée avec succès ! Un email de confirmation vous a été envoyé !');
    exit;
}

$conn->close();
?>