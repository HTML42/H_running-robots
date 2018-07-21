<?php
/*This page provides trips of a company in JSON to company.php*/
include 'dbcon.php';
$id = $_GET['id'];
$count=0;

$response = '{"shop":{"item":[';
//$count = 0; 
$stmt = $link->prepare("select name, coin, gold, dollar from Shop where typeId=?");
$stmt->bind_param('i', $id);
$stmt->execute();		
$stmt->store_result();
$stmt->bind_result($name,$coin,$gold,$euro);
	
while($stmt->fetch())
{
	$count++;
	$response = $response . '{"name": "' . $name . '","coin": "' . $coin . '","gold": "' . $gold . '","euro": "' . $euro . '"},';	
}
$stmt->close();

  
$link->close();
if ($count > 0)
	$response = substr($response, 0, -1);
echo $response.']}}';
?>