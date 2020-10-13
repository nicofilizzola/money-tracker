<?php 
	require "header.php";
?>

<main>

	<div class="container">
		
			<h2>Contactez nous !</h2>
			<br><br>
		
			<?php 
		
				if (isset($_GET['error'])){
					switch ($_GET['error']){
							
						// ERROR : FORM NOT FILLED
						case 'input':
							echo "<p><b>Vous n'avez pas rempli tout le formulaire. Veuillez réesayer.</b></p>";
							break;
						
						// ERROR : NAME NOT VALID
						case 'invalid-name':
							echo "<p><b>L'identification que vous avez renseigné n'est pas valide. Veuillez réesayer.</b></p>";
							break;
							
						// ERROR : EMAIL NOT VALID
						case 'invalid-email':
							echo "<p><b>L'adresse email que vous avez renseigné n'est pas valide. Veuillez réesayer.</b></p>";
							break;
							
					}
				}
		
			?>
		
			<form action="include/contact.inc.php" class="form-padding" method="post">
				<input type="text" name="name" placeholder="Nom et prénom...">
				<br><br>
				<input type="text" name="email" placeholder="Email...">
				<br><br>
				<input type="text" name="heading" placeholder="Objet...">
				<br><br>
				<textarea name="message" cols="30" rows="10" placeholder="Votre message..."></textarea>
				<br><br>
				<button type="submit" name="contact-submit">Envoyer</button>
			</form>

	</div>

</main>

<?php 
	require "footer.php";
?>