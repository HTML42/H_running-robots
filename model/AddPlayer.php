<?php

include 'dbcon.php';
include('lock.php');

$id=$_GET['id'];
$name=$_GET['user'];

/*Flag
 * 1= data entered
 * 0= data not entered
 * */
$flag=0;
//player table
if($name!="")
{
	$stmt = $link->prepare("insert into Players (id,name) VALUES (?,?)");
	$stmt->bind_param("is",$id,$name);
	if($stmt->execute()){
		$flag=1;
	}	
}
	
$response = '{"info":[{"res": "' . $flag. '"}]}';	
	echo $response;				
?>