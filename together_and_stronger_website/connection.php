<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css">
	<title>Connexion</title>
</head>
<body>
	<?php include('includes/header.php') ?>
	<main>
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
					<button type="submit" class="rounded-button">Se connecter</button>
				</div>
			</div>
		</form>
	</main>
		<?php include('includes/footer.php'); ?>
</body>
</html>