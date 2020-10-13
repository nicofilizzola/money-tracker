 <?php 

if (isset($_POST['login-submit'])) {
	
	require 'dbh.inc.php';
	
	$emailuid = $_POST["emailuid"];
	$password = $_POST["pwd"];
	
// CHECK IF INPUTS FILLED
	if (empty($emailuid) || empty($password)) {
		header("Location: ../index.php?error=input");
		exit();
		
	// CHECK IF USER/EMAIL EXISTS IN DATABASE
	} else {
		$sql = "SELECT * FROM users WHERE uid_users=? OR email_users=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sql_stmt_emailuid");
			exit();
			
		// ACTION: SEND DATA TO DATABASE TO COMPARE
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $emailuid, $emailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			// COMPARE PASSWORDS
			if ($row = mysqli_fetch_assoc($result)) {
				$password_check = password_verify($password, $row['pwd_users']);
				
				// IF PASSWORD DOES NOT MATCH
				if ($password_check == false) {
					header("Location: ../index.php?error=wrong_password&emailuid=".$emailuid);
					exit();	
					
				// LOG IN
				} elseif ($password_check == true) {
					
					// NEW SESSION
					session_start();
					$_SESSION['id_users'] = $row['id_users'];
					$_SESSION['email_users'] = $row['email_users'];
					$_SESSION['uid_users'] = $row['uid_users'];
					
					header("Location: ../index.php?login=success");
					exit();
					
				// ALTERNATIVE ERROR HANDLER
				} else {
					header("Location: ../index.php?error=wrong_password");
					exit();
				}
			} else {
				header("Location: ../index.php?error=emailuid_invalid");
				exit();
			}
		}
		
	}
	
// REDIRECT TO INDEX.PHP IF ACCESSED LOGIN.INC.PHP INCORRECTLY
} else {
	header("Location: ../index.php");
	exit();
}
