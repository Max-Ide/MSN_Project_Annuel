<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Réservation</title>
</head>
<body>
<?php
session_start();
include 'includes/header.php';
include('database\connection.php');
$full = $_GET['name'];
$q = 'SELECT (id) FROM activities WHERE name ="'.$full.'"';
$req = $conn->execute($q)
$req = $conn->mysqli_bind_result($results);
var_dump($results['id']);
$currentYear = date('Y');
?>
<form method="POST" action="activity_reservation.php" enctype="multipart/form-data">
    <label for="date">Date :</label>
        <input type="date" id="Actdate" name="Actdate"><br>

        <label for="heure">Heure :</label>
        <input type="time" id="Acttime" name="Acttime"><br>
        <label for="number">Nombre de participants :</label>
        <input name="number" id="number"><br>

    <input type="hidden" value="<?php echo $results['id'] ?>" name="id">
	<input type="submit">
</form>

</body>
</html>
