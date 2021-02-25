<?php 
	require "header.php";
?>

<main>
	
	<div class='container'>
		<div class='vertical-wrapper'>
		
		<?php

			// WELCOME MESSAGES FOR NEW USERS
			if(isset($_GET['state'])){

				// IF DIRECTLY REDIRECTED AFTER SIGNUP
				if ($_GET['state'] == 'new'){
					echo 
						"<p>Commençons par ajouter un compte. </p>";

				// IF REDIRECTED FROM HOME
				} elseif ($_GET['state'] == 'new2'){
					echo 
						"<p>Il faut toujours ajouter un premier compte. Allons y !</p>";
				}

			}

		?>
	
		<h2>Ajouter nouveau compte</h2>
		<form action="include/newaccount.inc.php" method="post" class="form-vertical">
			
			<?php

			require('include/dbh.inc.php');
			
			if (isset($_GET['step'])){
				switch ($_GET['step']) {
						
					// FIRST STEP
					case 'first':
						
						// ERROR MESSAGES
						if (isset($_GET['error'])){
							
							// IF MAX ACCOUNTS REACHED
							if ($_GET['error'] == 'max'){
								echo '<p><b>Vous avez déjà atteint le maximum de comptes (5). Passez à Money-Tracker Premium pour avoir accès illimité</b></p>'; 
								
							// SQL ERROR MESSAGE	
							} elseif ($_GET['error'] == 'sql_stmt_insert'){
								echo '<p><b>Nous sommes en train de rencontrer des problèmes techniques. Si ce problème persiste, <a href="contact.php">Contactez nous.</a></b></p>'; 
							
							// ALREADY EXISTING ACCOUNT ERROR MESSAGE
							} elseif ($_GET['error'] == 'existing'){
								echo '<p><b>Vous avez déjà ajouté cette banque. Vous ne pouvez pas ajouter le même compte plusieurs fois.</b></p>'; 
							
							// INPUTS NOT FILLED
							} else if ($_GET['error'] == 'input_new'){
								echo '<p><b>Vous n\'avez pas rempli toutes les cases. Veuillez récommencer.</b></p>';
							}
						
						}
						
						echo
						"<p>Sélectionnez le pays de votre compte :</p>
						<select name='country'>";

						// SQL ACTION: SELECT COUNTRIES AVAILABLE
						$sql = "SELECT DISTINCT country_accounts FROM accounts ORDER BY country_accounts;";
						$result = mysqli_query($conn, $sql);
						$resultCheck = mysqli_num_rows($result);

						if ($resultCheck > 0){
							while ($row = mysqli_fetch_assoc($result)) {
								echo 
								// SHOW COUNTRY OPTIONS
								"<option value='".$row['country_accounts']."'>".$row['country_accounts']."</option>";
							}
						}

						echo 
									"</select><br><br>
								<button type='submit' name='first-submit'>Étape suivante</button>
							</form>";
						
						break;
						
					// SECOND STEP
					case 'final':
						
						echo
								"<p>Séléctionnez votre banque et un montant de base :</p>
								<select name='account'>";

							// SQL ACTION: SELECT ACCOUNTS AVAILABLE
							$sql = "SELECT name_accounts, id_accounts FROM accounts WHERE country_accounts = ? ORDER BY name_accounts;";
							$stmt = mysqli_stmt_init($conn);

							// CHECK IF STATEMENT WORKS
							if (!mysqli_stmt_prepare($stmt, $sql)){
								header ("Location: newaccount.php?error=sql_stmt_select_account");
								exit();

							// EXECUTE SQL ACTION
							} else {
								mysqli_stmt_bind_param($stmt, "s", $_GET['country']);
								mysqli_stmt_execute($stmt);
							}
							$resultCheck = mysqli_stmt_get_result($stmt);
								while ($row = mysqli_fetch_assoc($resultCheck)) {

									// SHOW ACCOUNT OPTIONS
									echo 
										"<option value='".$row['id_accounts']."'>".$row['name_accounts']."</option>";
								}

							echo 
										"</select>
										<input type='number' name='amount' placeholder='Quantité...'>
										<input type='text' name='ref' placeholder='Référence...'>
										<input class='hidden' type='date' name='date' value=".date('Y-m-d').">
										<br><button type='submit' name='final-submit'>Valider</button>
									
								</form>";

						break;		
		
				}
				
			} else {
				
				header("Location: newaccount.php?step=first");
				
			}
			
			
			?>
	
		</div><!-- VERTICAL WRAPPER -->
	</div><!-- CONTAINER -->
	
</main>

<?php 
	require "footer.php";
?>