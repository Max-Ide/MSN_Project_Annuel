<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>connexion</title>
</head>
<body>
	<?php 
		include('includes/header.php')
	?>
	<main>
		<?php 
/*			if(isset($_GET['message']) && !empty($_GET['message'])){
				echo '<h3>' . htmlspecialchars($_GET['message']) . '</h3>';
			}
			if(!empty($_SESSION['username'])){
			$q = 'INSERT INTO connexion (url_page, username, date_co) VALUES (:url_page, :username, :date_co)';
			$req = $bdd->prepare($q);
			$req->execute([	
				'username' => $_SESSION['username'],
				'url_page' => 'connexion.php',
				'date_co' => date('h:i d/m/Y'),
			 ]);
			$results = $req->fetchAll();
			}
*/
		?>
		<form class="container" action="verification.php" method="POST">
			<div class="m-3 row" enctype="multipart/form-data">
		    	<div class="col-sm-10">
		    		<p>E-mail</p>
		      		<input type="email" class="form-control" name="email" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>" required>
		    	</div>
			</div>
			<div class="m-3 row">
		   		<div class="col-sm-10">
		   			<p>Mot de passe</p>
		    		<input type="password" name="password" class="form-control" required>
		    	</div>
			</div>
			<div class="m-3 row">
				<div class="col-sm-10" style="padding-top: 10px; scale: 90%; padding-right: 10px;">
					<button type="submit" class="rounded-button">se Connecter</button>
				</div>
			</div>
		</form>
	</main>
		<?php include('includes/footer.php'); ?>
</body>
</html>