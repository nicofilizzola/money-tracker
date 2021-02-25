<?php 

$db_servername = "localhost";
$db_uid = "nicolito";
$db_pwd = "hackersmaricos-melomaman";
$db_name = "money-tracker";

$conn = mysqli_connect($db_servername, $db_uid, $db_pwd, $db_name);

if (!$conn) {
	die ("Connection failed: ".mysqli_connect_error());
}