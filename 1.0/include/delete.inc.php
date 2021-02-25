<?php

// SETUP
require_once('dbh.inc.php');
session_start();

// CHECK BUTTON WAS PRESSED
if (isset($_POST['delete-submit'])){

	$account = $_POST['account-delete'];
	$sessionID = $_SESSION['id_users'];
	$sql = "DELETE FROM moves WHERE id_accounts = '$account' AND id_users = '$sessionID'";
	mysqli_query($conn, $sql);
	
	//REDIRECT
	header("Location: ../index.php?insert=delete");
	
// REDIRECT IF ACCESSED INCORRECTLY
} else {
	header("Location: ../index.php");
}

