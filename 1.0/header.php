<?php session_start(); ?>

<!doctype html>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
		<title>Money-Tracker</title>
		<link type="text/css" href='style.css' rel="stylesheet">
	</head>

	<body>
		<header>
			<nav>
				<a href="index.php">
					<img src="img/logo.png" alt="logo">
				</a>
				<div class="nav-buttons">
					<?php 

						if (isset($_SESSION['uid_users'])) {
							echo
								'<form action="include/logout.inc.php" method="post">
									<button type="submit" name="logout-submit">Se déconnecter</button>
								</form>';
						} else {
							echo 
								'<form action="include/login.inc.php" method="post">';
							
							if(isset($_GET['emailuid'])){
								echo '<input type="text" name="emailuid" placeholder="Email ou identifiant..." value="'.$_GET['emailuid'].'">';
							} else {
								echo '<input type="text" name="emailuid" placeholder="Email ou identifiant...">';
							}
									
							echo
									'<input type="password" name="pwd" placeholder="Mot de passe...">
									<button type="submit" name="login-submit">Connexion</button>
								</form>
								<form action="signup.php"><button type="submit">Créer un compte</button></form>';
							if (isset($_GET['error'])){
								$error = $_GET['error'];
								switch ($error) {
									case "input":
										echo "<p class='alert'>Vous n'avez pas rempli tout le formulaire. Veuillez réesayer.</p>";
										break;
									case "sql_stmt_emailuid":
										echo "<p class='alert'>Nous sommes en train de rencontrer des problèmes techniques. Veuillez réesayer plus tard.</p>";
										break;
									case "wrong_password":
										echo "<p class='alert'>Votre mot de passe est incorrect.</p>";
										break;
									case "emailuid_invalid":
										echo "<p class='alert'>Il n'y a aucun compte associé à votre email/identifiant.</p>";
										break;
								}
							}
						}
					?>
				</div>
				<div class="nav-buttons nav-buttons-responsive">
					<?php 

						if (isset($_SESSION['uid_users'])) {
							echo
								'<form action="include/logout.inc.php" method="post">
									<button type="submit" name="logout-submit">Se déconnecter</button>
								</form>';
						} 
					?>
				</div>
			</nav>
		</header>
		
		<video autoplay loop muted class="background">
			<source src="img/bgvideo.mp4">
		</video>
		
		<div class="background-overlay"></div>
