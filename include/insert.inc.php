<?php

session_start();

// IF FORM SENT
 if (isset($_POST['insert-submit'])){
	
	 require('dbh.inc.php');
	 
	 $amount = $_POST['amount'];
	 $ref = $_POST['ref'];
	 $date = $_POST['date'];
	 $account = $_POST['account'];
	 
	 // IF INPUTS ARE EMPTY 
	 if (empty($amount) || empty($ref)) {
		 // REDIRECT TO ERROR MESSAGE
		 header ("Location: ../index.php?error=".$account."&amount=".$amount."&ref=".$ref);
		 exit();
	
	// OTHERWISE
	 } else  {
		 
		 // SQL ACTION: INSERT INPUT DATA INTO MOVES
		 $sql = "INSERT INTO moves (id_users, id_accounts, amount_moves, ref_moves, date_moves) VALUES (?, ?, ?, ?, ?)";
		 $stmt = mysqli_stmt_init($conn);
		 
		 // CHECK IF STATEMENT WORKS
		 if (!mysqli_stmt_prepare($stmt,$sql)){
			 header ("Location: ../index.php?error=sql_stmt_insert_moves");
			 exit();
			 
		// EXECUTE STATEMENT
		 } else {
			 mysqli_stmt_bind_param($stmt, "iisss", $_SESSION['id_users'], $account, $amount, $ref, $date);
			 mysqli_stmt_execute($stmt);
			 
			 // REDIRECT
			 header("Location: ../index.php?insert=success");
		 }
	 }
	 
// IF ACCESSED FILE INCORRECTLY
 } else {
	 header("Location: ../index.php;");
	 exit();
 }