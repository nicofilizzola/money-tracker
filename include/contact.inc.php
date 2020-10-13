<?php
	
	// IF ACCESSED VIA CONTACT PAGE 
	if (isset($_POST['contact-submit'])){
		
		// LINK DB
		require "dbh.inc.php"; 
		
		// INPUT VARIABLES
		$name = $_POST['name'];
		$mailFrom = $_POST['email'];
		$subject = $_POST['heading'];
		$message = $_POST['message'];
		
		// ERROR : INPUTS NOT FILLED
		if (empty($name) || empty($mailFrom) || empty($subject) || empty($message)){
			header("Location: ../contact.php?error=input");
			exit();
			
		// ERROR : EMAIL NOT VALID
		} elseif (!filter_var($mailFrom, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../contact.php?error=invalid_email");
			exit();
		}
		
		// ERROR : NAME NOT VALID
		elseif (!preg_match("/^[a-zA-Z-\\s]*$/", $name)){
			header("Location: ../contact.php?error=invalid_name");
			exit();
		}
		
		// NO ERRORS : SEND MESSAGE
		else {
			
			$mailTo = "money-tracker@outlook.com";
			$subjectTitle = "Money-Tracker : ".$subject;
			$heading = "From : ".$mailFrom;
			$txt = "You received a message from ".$name."\n\nMessage:\n\n".$message;
			
			// SEND MESSAGE
			mail($mailTo, $subjectTitle, $txt, $heading);
			
			// REDIRECT
			header("Location: ../index.php?insert=message");
			exit();
		}
		
	// IF ACCESSED FILE INCORRECTLY 
	} else {
		header("Location: ../index.php");
		exit();
	}
	