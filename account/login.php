<?php
include '../model/dbcon.php';

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");



	session_start();
	if($_SERVER["REQUEST_METHOD"]== "POST")
	{
		switch($_POST['action'])
		{
			case "resetpass":
				$email=$_POST['email'];
				$code=uniqid(rand(),true);//unique identifier
				$time=time()+3600;//time for expiry of password reset link	
				
				console.log($email+"--");

				//update database 
				$stmt = $link->prepare("UPDATE Login SET code=?, link_time=? WHERE email=?");

				if($stmt !== FALSE) {
    				// do the binds...etc			
					$stmt->bind_param("sss",$code,$time,$email);
					$stmt->execute();	
					
					//Send email for password reset
					
					//Email text
					//$msg="Hello\n\nA password reset was requested for your Running Robot account.\n";

					 
					$msg="Hello\n\nPlease use this link to reset your password http://localhost/p_site/H_running-robots/account/resetpwd.php?=".$code."\n
					If you didn't requested password reset link then ignore this email, this link will automatically become invalid after 1 hour.\n
					\n
					Best Wishes and Regards\n";
					
					$msg = wordwrap($msg,70);
					// send email
					mail($email,"Running Robot - Password Reset Link",$msg);
					// console.log($msg);
					 //echo "<script>alert('A link has been sent to your email address for reseting your password. If link is not in Inbox then check your spam folder, Thank you')</script>";
				}
				else {
					echo "failed";
				}
	//			header("Location: ../index.html");
			break;		
			case "login":
			
				//$email="ab123@mail.com";
				//$password="Abcd1234";
				
				$email=$_POST['username'];
				$password=$_POST['password'];
		
				$stmt = $link->prepare("select id,password from Login where email=?");
				$stmt->bind_param('s', $email);
				$stmt->execute();		
				$stmt->store_result();
				$stmt->bind_result($cdid,$hash);
				if($stmt->fetch())
				{
					echo $cdid."--".$hash."<br>";
				
					if (password_verify($password, $hash))//verify if password is correct 
					{
						echo $password."--".$hash;
//print_r($stmt->error_list);				
						$_SESSION['login_user']=$email;
						$_SESSION['cdid']=$cdid;
						header("Location: ../dashboard.php");
					}//inner if end 
					else {
			    		echo 'Password verification failed';
					}
				}//outer if end 
				else {
					echo "Failed\n";
				}
			break;
	}//switch end
	//	$stmt->close();
	}//if end
?>
<!DOCTYPE html>
<head>
	<title>Running Robot</title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
			//display forgot password, hide forgot password
			function ShowForgotPwd()
			{
				$('#login').hide();
				$('#forgotpwd').show();
			}
			//display login password, hide forgot password
			function ShowLogin()
			{
				$('#login').show();
				$('#forgotpwd').hide();
			}
			function HideForgotPwd()
			{
				$('#forgotpwd').hide();
			}
    	</script>
</head>
	<body onload="HideForgotPwd()">
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    	<a class="navbar-brand logo" href="../index.html" ><strong>R-R</strong></a>
    </nav>
	<br /><br /><br /><br />
<!--BODY ------------------------------->
		<div class="container-fluid">
	        
			<!--Login Section-->
  			<section class="row" id="login">
   				<div class="col-xs-0 col-sm-2 col-md-4 col-lg-4"></div>
   				<div class="col-xs-12 col-sm-8 col-md-4 col-lg-4 box">
   					<h4 id="heading">Welcome! Log in</h4>
   					<hr />
   					<form action="" method="post" >
   						<!--Email-->
						<div class="form-group">
							<div class="input-group">    							
    							<input class="form-control" type="text" name="username" placeholder="Email address"/>
  							</div>
						</div>
						<!--Password-->
						<div class="form-group">
							<div class="input-group">    							
    							<input class="form-control" type="password" name="password" placeholder="Password"/>
  							</div>
						</div>
						<input type="hidden" name="action" value="login">
						<input type="submit" class="btn btn-default font-normal" value="Login" style="background-color:#33EE33;color:#9900FF;font-weight: bolder;"/><br />			
					</form>				
					<hr />
					<a href="register.php">Create Account</a> 
					<label id="frgtpwd" onclick="ShowForgotPwd()">Forgot Password</label>
				</div>
				<div class="col-xs-0 col-sm-2 col-md-4 col-lg-4"></div>
  			</section>
  			<!--Forgot Password Section-->
  			<section class="row" id="forgotpwd">
   				<div class="col-xs-0 col-sm-2 col-md-4 col-lg-4"></div>
   				<div class="col-xs-12 col-sm-8 col-md-4 col-lg-4 box">
   					<h4 id="heading">Password Recovery, Enter Email</h4>
   					<hr />
   					<form action="" method="post" >
   						<Email>
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-envelope' style='color:green'></span></div>
						    	<input class="form-control" type="text" name="email" value="" placeholder="Email address"/>
  							</div>
						</div>
						<label id="pwd_msg"></label>
						<input type="hidden" name="action" value="resetpass"><br />
						<input type="submit" class="btn btn-default font-normal" value="Email Password Reset Link" style="background-color:#33EE33;color:#9900FF;font-weight: bolder;"/><br />			
					</form>		
					<hr />
					<label id="frgtpwd" onclick="ShowLogin()">Login</label>		
				</div>
				<div class="col-xs-0 col-sm-2 col-md-4 col-lg-4"></div>
  			</section>
		</div>
		<br /><br /><br /><br />
		<!-- Footer -->
	<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Running Robots</h5>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<ul class="list-unstyled quick-links">
						<li><a href="contact.php"><i class="fa fa-angle-double-right"></i>Contact</a></li>
						<li><a href="shop.html"><i class="fa fa-angle-double-right"></i>Shop</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<ul class="list-unstyled quick-links">
						<li><a href="imprint.html"><i class="fa fa-angle-double-right"></i>Imprint</a></li>
						<li><a href="privacy.html"><i class="fa fa-angle-double-right"></i>Privacy Policy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<!--Footer End-->
	</body>
