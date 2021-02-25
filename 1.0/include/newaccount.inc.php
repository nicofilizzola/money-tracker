<?php

session_start();
require_once('dbh.inc.php');

// FIRST STEP : COUNTRY SELECT
if (isset($_POST['first-submit'])){
	$country = $_POST['country'];
	header('Location: ../newaccount.php?step=final&country='.$country);
	exit();
}

// SECOND STEP : ACCOUNT SELECT + FIRST TRANSFER
elseif (isset($_POST['final-submit'])){
	
	// INPUT VARIABLES
	$account = $_POST['account'];
	$amount = $_POST['amount'];
	$ref = $_POST['ref'];
	$date = $_POST['date'];
	$sessionID = $_SESSION['id_users'];
	
	// ERROR : INPUTS NOT FILLED
	if (empty($amount) || empty($ref) || empty($account)){
		header('Location: ../newaccount.php?step=first&error=input_new');
		exit();
	}
	
	// SEARCH WHICH ACCOUNTS THIS PERSON HAS
	$sql = "SELECT DISTINCT id_accounts FROM moves WHERE id_users = '$sessionID'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		// COMPARE THEM WITH THE ONE THEY WANT TO ADD AND REDIRECT IF EXISTING
		if ($account == $row['id_accounts']){
			header("Location: ../newaccount.php?step=first&error=existing");
			exit();
		}
	}
	
	// SEARCH ACCOUNT QUANTITY
	$sql = "SELECT COUNT(DISTINCT id_accounts) FROM moves WHERE id_users = '$sessionID'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		$accountQuantity = $row['COUNT(DISTINCT id_accounts)'];
	}
	
	// IF THERE ARE MOTE THAN 5 ACCOUNTS, REDIRECT
	if ($accountQuantity >= 5){
		header ('Location: ../newaccount.php?step=first&error=max');
		exit();

	// IF NO ERROR
	} else {
		
		// SQL ACTION : INSERT INPUTS INTO DATABASE
		$sql = "INSERT INTO moves (id_users, id_accounts, amount_moves, ref_moves, date_moves) VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($conn);
		
		// CHECK IF STATEMENT WORKS
		if (!mysqli_stmt_prepare($stmt,$sql)){
			 header ("Location: ../newaccount.php?step=first&error=sql_stmt_insert");
			 exit();
			 
		// EXECUTE STATEMENT
		 } else {
			 mysqli_stmt_bind_param($stmt, "iisss", $sessionID, $account, $amount, $ref, $date);
			 mysqli_stmt_execute($stmt);
			
			var_dump($_POST['account']);
			 
			 // REDIRECT
			 header("Location: ../index.php?insert=newaccount");
		 }
	}
	
// IF FILE ACCESSED INCORRECTLY REDIRECT	
} else {
	header ('Location: ../index.php');
}


