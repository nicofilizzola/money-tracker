<?php 
	require "header.php";
?>

<main>

	<div class='container'>
	
		<h2>Supprimer un compte</h2>
		<p>Choisissez la banque que vous souhaitez supprimer (Veuillez faire attention, les données du compte supprimé ne pourront pas être récupérés par la suite) :</p><br>
		<form action='include/delete.inc.php' method='post'>
			<select name="account-delete">
			
				<?php
				// LINK TO DB
				require_once('include/dbh.inc.php');
				
				// SEARCH FOR EXISTING ACCOUNTS
				$sessionID = $_SESSION['id_users'];
				$sql = "SELECT DISTINCT accounts.id_accounts, accounts.name_accounts FROM accounts, moves WHERE moves.id_users = '$sessionID' AND accounts.id_accounts = moves.id_accounts";
				
				$result = mysqli_query($conn, $sql);
				
				// ECHO RESULTS AS SELECT OPTIONS
				while ($row = mysqli_fetch_assoc($result)){
					echo '<option value="'.$row['id_accounts'].'">'.$row['name_accounts'].'</option>';
				}
				?>
			
			</select>
			<button type="submit" name="delete-submit">Supprimer</button>
		</form>
	</div>
	
</main>

<?php 
	require "footer.php";
?>
