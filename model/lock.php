<?php 
include '../model/dbcon.php';

session_start();
$user_check=$_SESSION['login_user'];

$stmt = $link->prepare("select email from Login where email=?");
$stmt->bind_param('i', $user_check);
$stmt->execute();		

$stmt->store_result();
$stmt->bind_result($email);
if($stmt->fetch())
{
	$login_session=$email;
	//check if login_session has been set or not
	if(!isset($login_session))
	{
		//echo "Failed\n";
		header("Location: login.php");
	}
	else{
		//header("Location: dashboard.php");
	}
}
else {//Not loged in
	header("Location: login.php");
}
$stmt->close();

?>
