<?php
include 'dbcon.php';

session_start();
/*This page provides trips of a company in JSON to company.php*/
include 'dbcon.php';
if($_SESSION['cdid'])
{
	$id = $_SESSION['cdid'];	
}
else{
	$id=-1;
}

$response = '{"info":[{"id": "' . $id. '"}]}';	
echo $response;

?>