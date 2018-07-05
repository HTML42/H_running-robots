<?php
include '../model/dbcon.php';

//
 if($_SERVER["REQUEST_METHOD"]== "POST")
{
	$code=$_GET['code'];//get from URL
	$newpwd=$_POST['newpwd'];
	$newpwd_retype=$_POST['newpwd_retype'];

	if($newpwd==$newpwd_retype)//Check if passwords match
	{
		checkPassword($newpwd); //check format of password
	}//if ends
	
	//No error, add data to DB and register user
	if(!isset($_SESSION['error']))
	{	
		$stmt = $link->prepare("select link_time from Login where code=?");
		$stmt->bind_param('s', $code);
		$stmt->execute();		
		$stmt->store_result();
		$stmt->bind_result($time);
		$stmt->fetch();
		if($time>time())
		{
			$options = [
			  'cost' => 12
			];
			$pwd=password_hash($newpwd, PASSWORD_BCRYPT, $options);//hash password
			$new_code="0";//set code back to zero
			$stmt = $link->prepare("update Login set password=?,code=? where code=?");
			$stmt->bind_param('sss', $pwd,$new_code,$code);
			$stmt->execute();	 	
		}
		else{
			$_SESSION['error'] = "link expired";
		}	
	}//outer if end
}//Check POST end

	//Check password
	function checkPassword($pwd) 
	{    
		if (!preg_match("#[A-Za-z]+#", $pwd) || !preg_match("#[0-9]+#", $pwd) || strlen($pwd) < 8) {
			$_SESSION['error'] = "<i>For password use 8 characters or more, having numbers and letters.</i>";
		}
	}	
?>

<!DOCTYPE html>
<head>
	<title>Running Robot - Reset Password</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style/style.css">
        <script>
    		function CheckPass()
    		{
				//console.log("checkng");
				var pwd1= document.getElementById('newpwd').value;
				var pwd2= document.getElementById('newpwd_retype').value;
				if(pwd1!=pwd2)
				{
					document.getElementById('pwd_msg').innerHTML="Password should match";
				}
				else
				{
					document.getElementById('pwd_msg').innerHTML="Password match";
				}	
			}//CheckPass
			
    	</script>
</head>
	<body>
		<div class="container-fluid">
	        <!--Top Row-->
  			<?php
			include_once("../design/layout.php");
				SimplePageHeader();
	 		?>
			
  			<!--Forgot Password Section-->
  			<section class="row" >
   				<div class="col-xs-0 col-sm-2 col-md-4 col-lg-4"></div>
   				<div class="col-xs-12 col-sm-8 col-md-4 col-lg-4 box">
   					<h4 id="heading">Welcome! Enter New Password</h4>
   					<hr />
   					<form action="" method="post" >
   						<!--Password-->
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-lock' style='color:green'></span></div>
						    	<input class="form-control" type="password" name="newpwd" id="new" onchange="CheckPass()" placeholder="Password"/>
  							</div>
						</div>
						<!--Retype Password-->
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-lock' style='color:green'></span></div>
						    	<input class="form-control" type="password" name="newpwd_retype" id="newretype" onchange="CheckPass()" placeholder="Retype Password"/>
  							</div>
						</div>
						<i>For password use 8 characters or more, having numbers and letters</i><br />
						<!--Email-->
						<label id="pwd_msg"></label>
						<input type="submit" class="btn btn-success" value="Reset Password"/><br />			
					</form>	
					<?php
						if(isset($_SESSION['error']))
						{
							echo '<h5 style="color:red">'.$_SESSION['error'].'</h5>';
							unset($_SESSION['error']);
						}
					?>			
					<hr />
				</div>
				<div class="col-xs-0 col-sm-2 col-md-4 col-lg-4"></div>
  			</section>
		</div>
	</body>
