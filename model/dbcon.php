<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "pass";

$mysql_database = "h_runningrobots_dev";

	$link = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database)	or 	die('Not connected:');
?>
