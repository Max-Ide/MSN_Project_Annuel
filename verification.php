<?php 


	if(isset($_POST['email']) && !empty($_POST['email'])){
		setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
	}

	if(empty($_POST['email']) || empty($_POST['password'])){
		header('location: connection.php?message=Vous devez remplir les 2 champs.');
		exit;
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		header('location: connection.php?message=Email invalide.');
		exit;
	}
	include('database\connection.php');
	$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$query = $conn->prepare('SELECT prenom, nom FROM users WHERE email= :email AND password = :password');
$query->execute([
					'email' => $_POST['email'],
					'password' =>   $_POST['password'],
				]);
$results = $query->fetchAll();
if ( count($results) == 0 ){
	header('location: connection.php?message=Identifiants incorrects.');
	exit;
}

	session_start();

	$_SESSION['email'] = $_POST['email'];
	$q = 'SELECT nom, prenom, entreprise FROM users WHERE email="' . $_POST['email'] . '"' ;
    $req = $conn-> query($q);
    $pass = $req->fetch();
	$_SESSION['nom'] = $pass['nom'];
	$_SESSION['prenom'] = $pass['prenom'];
	$_SESSION['entreprise'] = $pass['entreprise'];

	$q = 'SELECT is_admin FROM users WHERE email="' . $_POST['email'] . '"' ;
    $req = $conn-> query($q);
    $pass = $req->fetch();

	if($pass[0] == 1){
		header('location: admin.php');
		exit;
	}

	header('location: index.php');
	exit;
?>