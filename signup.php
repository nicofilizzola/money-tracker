<?php 
	require "header.php";
?>

<main>
	<div class="container">
		<h2>Sign up</h2>
		<br><br>
		<?php
		
			// ERROR MESSAGES
			if (isset($_GET["error"])){
				$error = $_GET["error"];
				switch ($error) {
					case "empty":
						echo "<p class='alert'>Vous n'avez pas rempli le formulaire. Veuillez réesayer.</p>";
						break;
					case "invalid_email":
						echo "<p class='alert'>Votre adresse email n'est pas valide. Veuillez réesayer.</p>";
						break;
					case "invalid_uid":
						echo "<p class='alert'>Votre identifiant n'est pas valide. Les caractères spéciaux sont interdits. </p>";
						break;
					case "password_check":
						echo "<p class='alert'>Les mots de passe ne correspondent pas. Veuillez réesayer.</p>";
						break;
					case "sql_stmt_uid_check":
						echo "<p class='alert'>Nous sommes en train de rencontrer des problèmes techniques. Veuillez réesayer plus tard.</p>";
						break;
					case "uid_taken":
						echo "<p class='alert'>Cet identifiant n'est plus disponible. Veuillez réesayer.</p>";
						break;
					case "sql_stmt_email_check":
						echo "<p class='alert'>Nous sommes en train de rencontrer des problèmes techniques. Veuillez réesayer plus tard.</p>";
						break;
					case "email_taken":
						echo "<p class='alert'>Cette adresse email n'est plus disponible. Veuillez réesayer.</p>";
						break;
					case "sql_stmt_insert":
						echo "<p class='alert'>Nous sommes en train de rencontrer des problèmes techniques. Veuillez réesayer plus tard.</p>";
						break;
				}
			}
		
		?>
		<form action="include/signup.inc.php" method="post" class="form-padding">
			<input type="text" name="email" placeholder="E-mail" value="<?php if(isset($_GET['email'])){echo ($_GET['email']);}?>">
			<br><br>
			<input type="text" name="uid" placeholder="Identifiant" value="<?php if(isset($_GET['uid'])){echo ($_GET['uid']);}?>">
			<br><br>
			<input type="password" name="pwd" placeholder="Mot de passe">
			<br><br>
			<input type="password" name="pwd-repeat" placeholder="Vérifiez votre mot de passe">
			<br><br>
			<button type="submit" name="signup-submit">Démarrer</button>
		</form>
	</div>
</main>

<?php 
	require "footer.php";
?>