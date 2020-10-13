<?php

	if (isset($_POST['signup-submit'])){

		require "dbh.inc.php";

		$username = $_POST['uid'];
		$email = $_POST['email'];
		$password = $_POST['pwd'];
		$password_confirm = $_POST['pwd-repeat'];
		
		// IF INPUTS NOT FILLED
		if (empty($username) || empty($email) || empty($password) || empty($password_confirm)){
			header("Location: ../signup.php?error=empty&uid=".$username."&email=".$email);
			exit();
			
		// IF EMAIL NOT VALID
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?error=invalid_email&uid=".$username);
			exit();
			
		// IF USER NOT VALID
		} elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			header("Location: ../signup.php?error=invalid_uid&email=".$email);
			exit();
			
		// IF PASSWORDS ARE NOT THE SAME
		} elseif ($password !== $password_confirm) {
			header("Location: ../signup.php?error=password_check&uid=".$username."&email=".$email);
			exit();
				
		// CHECK USER AVAILABLE
		} else {
			$sql = "SELECT uid_users FROM users WHERE uid_users=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sql_stmt_uid_check");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0) {
					header("Location: ../signup.php?error=uid_taken&email=".$email);
					exit();
				}
			}
			
			// CHECK EMAIL AVAILABLE
			$sql = "SELECT email_users FROM users WHERE email_users=?";
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sql_stmt_email_check");
				exit();
			} else {
				mysqli_stmt_bind_param($stmt, "s", $email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0) {
					header("Location: ../signup.php?error=email_taken&uid=".$username);
					exit();
					
				// ACTION: INSERT DATA
				} else {
					$sql = "INSERT INTO users (email_users, uid_users, pwd_users) VALUES (?, ?, ?)";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sql_stmt_insert");
						exit();
					} else {
						
						// HASH PASSWORD
						$password_hash = password_hash($password, PASSWORD_DEFAULT);
						
						// EXECUTE STATEMENT
						mysqli_stmt_bind_param($stmt, "sss", $email, $username, $password_hash);
						mysqli_stmt_execute($stmt);
						
						session_start();
						
						$_SESSION['email_users'] = $email;
						$_SESSION['uid_users'] = $username;
						
						$sql = "SELECT id_users FROM users WHERE email_users = '$email'";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)){
							$_SESSION['id_users'] = $row['id_users'];
						}
						
						// REDIRECT SUCCESSFUL
						header("Location: ../newaccount.php?step=first&state=new");
						exit();
					}
				}
			}
		}
		
		// CLOSE STATEMENT AND DATABASE CONNECTION
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		
	// REDIRECT TO SIGNUP.PHP IS ACCESSED SIGNUP.INC.PHP OTHERWISE
	} else {
		header("Location: ../signup.php");
		exit();
	}