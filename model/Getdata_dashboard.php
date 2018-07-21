<?php
session_start();
/*Get data for dashboard*/
include 'dbcon.php';
include('lock.php');

$id = $_SESSION['cdid'];

$count=0;

$response = '{"player":{"info":[';
//$count = 0; 
$stmt = $link->prepare("select name, levels, coins, gold from Players where id=?");
$stmt->bind_param('i', $id);
$stmt->execute();		
$stmt->store_result();
$stmt->bind_result($name,$levels,$coin,$gold);
	
while($stmt->fetch())
{
	$count++;
	$response = $response . '{"name": "' . $name . '","levels": "' . $levels . '","coin": "' . $coin . '","gold": "' . $gold . '"},';	
}
$stmt->close();

  
$link->close();
if ($count > 0)
	$response = substr($response, 0, -1);
echo $response.']}}';
?>