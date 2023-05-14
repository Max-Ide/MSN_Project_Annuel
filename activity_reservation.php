<?php 
session_start();
	include('database\connection.php');
	$q = 'SELECT reservation_name, id FROM reservation WHERE state ="on going" AND reservation_name ="' . $_SESSION['entreprise'] . '"';
	$query = $conn->mysqli_query($q);
	$results = $query->fetchAll();
	$Actdate = strtotime($_POST['Actdate']);
	$timeOfAct = strtotime($_POST['Acttime']);
	$participants = $_POST['number'];
	if ( count($results) == 0 ){
		$query = $conn->prepare('INSERT INTO reservation (id_activities, reservation_name, state, dateOfAct, timeOfAct, participants) VALUES (:id_activities, :reservation_name, :state, :dateOfAct, timeOfAct, :participants)');
		$query->execute([
			'reservation_name' => $_SESSION['entreprise'],
			'id_activities' => $_POST['id'].',',
			'state'=> "on going",
			'dateOfAct'=> $_POST['Actdate'],
			'timeOfAct'=> $_POST['Acttime'],
			]);
	}else{
		$conn->exec('UPDATE reservation SET id_activities = CONCAT(id_activities,",",'.$_POST['id'].'), dateOfAct = '.$Actdate.', timeOfAct = '.$timeOfAct.', participants = '.$participants.' WHERE state ="on going" AND reservation_name ="' . $_SESSION['entreprise'] . '"');
	};
header('location:activities.php');

?>