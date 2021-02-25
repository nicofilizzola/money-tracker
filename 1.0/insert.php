<?php

echo 
	"<form action='include/insert.inc.php' method='post'>
		<input type='number' name='amount' placeholder='Amount...'>
		<input type='text' name='ref' placeholder='Tag...'>
		<input class='hidden' type='date' name='date' value=".date('Y-m-d').">
		<input class='hidden' type='text' name='account' value=".$_GET['account'].">
		<button type='submit' name='insert-submit'>New move</button>
	</form>";

if (isset($_GET['insert'])){
	echo
		"<form action='include/undoinsert.inc.php'>
			<button class='undo' type='submit' name='undoinsert-submit'></button>
		</form>";
}