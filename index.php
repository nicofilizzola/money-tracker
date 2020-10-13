<?php 
	require "header.php";
?>
<main>
	<div class="container">
		<?php

			require("include/dbh.inc.php");
		
			// IF YOU JUST ADDED A NEW ACCOUNT/MOVE MESSAGE
			if (isset($_GET['insert'])){
				switch ($_GET['insert']){
					// NEW MOVE
					case 'success':
						echo '<p>Vous avez ajouté un nouveau mouvement avec succès !';
						break;

					// NEW ACCOUNT
					case 'newaccount':
						echo '<p>Vous avez ajouté un nouveau compte avec succès !';
						break;

					case 'delete':
						echo '<p>Vous avez supprimé un compte avec succès !</p>';
						break;
						
					case 'message':
						echo '<p>Votre message a bien été envoyé ! Nous essayerons de vous répondre dans les meilleurs délais.';
						break;
				}
			}

			if (isset($_SESSION['uid_users'])) {

				// CHECK MOVES
				$sql = "SELECT amount_moves FROM moves WHERE id_users=?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: index.php?error=sql_stmt_check_moves");
					exit();
				} else {
					mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_users']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$resultCheck = mysqli_stmt_num_rows($stmt);
					// IF THERE ARE NO MOVES
					if ($resultCheck == 0) {
						header('Location: newaccount.php?step=first&state=new2');

					// IF THERE ARE MOVES
					} elseif ($resultCheck > 0){

						// SQL ACTION: SELECT ACCOUNT'S NAMES ACCORDING TO USER ID
						$sql = "SELECT DISTINCT name_accounts, accounts.id_accounts FROM accounts, moves WHERE accounts.id_accounts = moves.id_accounts AND moves.id_users = ?";
						$stmt = mysqli_stmt_init($conn);

						// VERIFY THAT STATEMENT WORKS
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							header("Location: index.php?error=sql_stmt_check_accounts_name");
							exit();
						} else {

							// CREATE DIV WITH TITLE "ACCOUNT NAME"
							mysqli_stmt_bind_param($stmt, "i", $_SESSION['id_users']);
							mysqli_stmt_execute($stmt);
							$resultCheck = mysqli_stmt_get_result($stmt);
							while ($row = mysqli_fetch_assoc($resultCheck)) {
								echo 
									"<div class='vertical-wrapper accounts-wrapper'>
										<h2>".$row['name_accounts']."</h2>
										<table>
											<thead>";
								
								// ERROR : IF CASES NOT FILLED
								if (isset($_GET['error']) && $_GET['error'] == $row['id_accounts']){
									echo '<p>Vous n\'avez pas rempli toutes les cases. Veuillez réesayer.</p>';
								}
								

								// SQL ACTION: SHOW TOTAL BY ACCOUNT
								$sql2 = "SELECT SUM(amount_moves), currency_accounts FROM moves, accounts, users WHERE users.id_users = moves.id_users AND users.id_users = ? AND moves.id_accounts =  accounts.id_accounts AND accounts.id_accounts = ?;";
								$stmt2 = mysqli_stmt_init($conn);

								// VERIFY THAT STATEMENT WORKS 
								if (!mysqli_stmt_prepare($stmt2, $sql2)) {
									header ("Location: index.php?error=sql_stmt_total");
									exit();

								// EXECUTE ACTION
								} else {
									mysqli_stmt_bind_param($stmt2, "ii", $_SESSION['id_users'], $row['id_accounts']);
									mysqli_stmt_execute($stmt2);
									$resultCheck2 = mysqli_stmt_get_result($stmt2);
									while ($row2 = mysqli_fetch_assoc($resultCheck2)) {
										echo 
												"<tr>
													<td>".$row2['SUM(amount_moves)']." ".$row2['currency_accounts']."</td>
													<td colspan='2'>TOTAL DU MOIS</td>
												</tr>
											</thead>";

									}
								}

								"</thead>";

								// INSERT FORM
								echo 
									"<form action='include/insert.inc.php' method='post'>";
								
								// IF USER ALREADY TYPED SOMETHING
								if (isset($_GET['amount'])){
									echo "<input type='number' name='amount' placeholder='Quantité...' value='".$_GET['amount']."'>";
								} else if (isset($_GET['ref'])){
									echo "<input type='number' name='amount' placeholder='Quantité...' value='".$_GET['ref']."'>";
								} else {
									echo "<input type='number' name='amount' placeholder='Quantité...'>";
								}
										
								echo
										"<input type='text' name='ref' placeholder='Référence...'>
										<input class='hidden' type='date' name='date' value=".date('Y-m-d').">
										<input class='hidden' type='text' name='account' value=".$row['id_accounts'].">
										<button type='submit' name='insert-submit'>Nouveau mouvement</button>
									</form>";

								// SQL ACTION: SELECT DATA FROM MOVES ACCORDING TO ACCOUNT AND USER ID
								$sql2 = "SELECT moves.amount_moves, moves.ref_moves, moves.date_moves, currency_accounts FROM moves, accounts, users WHERE moves.id_accounts = accounts.id_accounts AND accounts.name_accounts = ? AND users.id_users = moves.id_users AND moves.id_users = ? AND moves.date_moves LIKE ? ORDER BY id_moves DESC;";
								$stmt2 = mysqli_stmt_init($conn);

								// VERIFY THAT STATEMENT WORKS
								if (!mysqli_stmt_prepare($stmt2, $sql2)) {
									header("Location: index.php?error=sql_stmt_check_accounts_data");
									exit();
								} else {

									// ECHO MOVES DATA
									$month = "%-".date("m")."-%";
									mysqli_stmt_bind_param($stmt2, "sis", $row['name_accounts'], $_SESSION['id_users'], $month);
									mysqli_stmt_execute($stmt2);
									$resultCheck2 = mysqli_stmt_get_result($stmt2);
									while ($row2 = mysqli_fetch_assoc($resultCheck2)) {
										echo 
											"<tr>
												<td>".$row2['amount_moves']." ".$row2['currency_accounts']."</td>
												<td>".$row2['ref_moves']."</td>
												<td>".$row2['date_moves']."</td>
											</tr>";
									}
								}

								// CLOSE DIV
								echo 	
											"</tbody>
										</table>
									</div>
									<hr>";
							} 

						}
					}

				}

				echo "<form action='newaccount.php' class='form-down'>
						<button type='submit'>Ajouter un compte</button>
					</form>";
				
				// COUNT HOW MANY ACCOUNTS THE USER HAS
				$sessionID = $_SESSION['id_users'];
				$sql = "SELECT COUNT(DISTINCT id_accounts) FROM moves WHERE id_users = '$sessionID'";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($result)){
					$accountQuantity = $row['COUNT(DISTINCT id_accounts)'];
				}
				
				//IF THERE ARE AT LEAST TWO ACCOUNTS
				if ($accountQuantity >= 2) {
					echo "<form action='delete.php' class='form-down'>
							<button type='submit'>Supprimer un compte</button>
						</form>";
				}

			} else {

				echo 
							"<div class='hero-wrapper'>
								<div class='vertical-wrapper presentation-wrapper'>
									<h1>Money-Tracker</h1>
									<h2>Ayez le contrôle</h2>
									<p><b>Money-Tracker</b> est un outil de gestion financière manuelle. Sur cette plateforme, vous pouvez noter tous vous mouvements bancaires du mois afin de mieux administrer votre argent et de savoir combien il vous en reste dans la poche.</p> 
									<p class='secondary-text'><b>Money-Tracker</b> a été crée pour tous ceux qui ont du mal a suivre leurs dépenses avec des outils de gestion automatisés, c'est pour cette raison que nous ne vous demandons pas vos cordonnées bancaires. C'est vous qui notez, <i>c'est vous qui avez le contrôle.</i></p>
									<a href='#login'><img src='img/pull.png' alt='logo' id='pull'></a>
								</div>
								<img src='img/logo.png' alt='logo' class='img-full'>
							</div>	
						</div>
					</main>
					
					<main class='responsive-loginbox' id='login'>
						<div class='container loginbox'>
							<h2>Connectez-vous ou créez un compte</h2>
							<form action='include/login.inc.php' method='post'>
								<input type='text' name='emailuid' placeholder='Email ou identifiant...'><br><br>
								<input type='password' name='pwd' placeholder='Mot de passe...'><br><br>
								<button type='submit' name='login-submit'>Connexion</button><br><br>
							</form>
							<form action='signup.php'><button type='submit'>Créer un compte</button></form>";

				}


		?>
	</div>
</main>

<?php 
	require "footer.php";
?>
