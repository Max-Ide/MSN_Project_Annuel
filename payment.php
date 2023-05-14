<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Panier</title>
</head>
<body>
<?php 
include 'includes/header.php';
include('database\connection.php');
setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
session_start();
$q = 'SELECT a.name, r.id_activities, r.participants, r.dateOfAct, r.timeOfAct, r.reservation_name FROM reservation as r LEFT JOIN activities as a ON a.id = r.id_activities WHERE state = "on going" AND reservation_name = "'.$_SESSION['entreprise'].'"';
$req = $conn->mysqli_query($q);
$results = $req->fetch();
$activ = explode(",",$results['id_activities']);
foreach ($activ as $key) {
	$q = 'SELECT a.name, a.img , a.price, r.id_activities, r.participants, r.dateOfAct, r.timeOfAct, r.reservation_name FROM activities as a  LEFT JOIN reservation as r ON a.id = r.id_activities WHERE a.id = "'.$key.'"';
	$req = $conn->mysqli_query($q);
	$results = $req->fetch();
	echo '<div>';
	echo $results['name']."<br>";
	echo "nombre de participants : ".$results['participants']."<br>";
	echo "Date de l'activité: ".date('d-m-Y',$results['dateOfAct'])."<br>";
	echo "Heure de l'activité: ".date('H:i',$results['timeOfAct'])."<br>";
	echo $results['img']."<br>";
	echo $results['price']*$results['participants']." € <br>";
	echo '</div>';
	echo "<br>";

}
?>
</body>
</html>
