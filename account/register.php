<?php
include '../model/db_con.php';
	session_start();
include("../lib/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();

	if($_SERVER["REQUEST_METHOD"]== "POST")
	{
		//echo $captcha.'-'.$_SESSION['captcha']['code'];
		if(addslashes($_POST['captcha']) == $_SESSION['captcha']['code'] || 1==1)//Add trip if captcha is correct, to protect against bots
		{
			if($_POST['email'] == '')
			{
				$_SESSION['error'] = "Enter your e-mail.";
			}
			else
			{
				//whether the email format is correct
				if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email']))
				{
					//if it has the correct format whether the email has already exist
					$email=$_POST['email'];
					$sql1 = "SELECT * FROM Login WHERE email = '$email'";
					$result1 = mysqli_query($link,$sql1) or die(mysqli_error());
					if (mysqli_num_rows($result1) > 0)
					{
						$_SESSION['error'] = "Email address already exists.";
					}
				}
				else
				{
					//this error will set if the email format is not correct
					$_SESSION['error'] = "Invalid email address.";
				}
			}//else end
			
			//$email=addslashes($_POST['email']);
			$password=$_POST['password'];
			checkPassword($password);

			
			//No error, add data to DB and register user
			if(!isset($_SESSION['error']))
			{
				$code=0;
				$options = [
				  'cost' => 12
				];
			
				$password=password_hash($password, PASSWORD_BCRYPT, $options);//hash password
				$stmt = $link->prepare("insert into Login (email,password,code) VALUES (?,?,?)");
				$stmt->bind_param("ssi",$email,$password,$code);

				if($stmt->execute())
				{
					$_SESSION['error'] = "Account successfully created";
					//header("Location: login.php");
				}
			}	
		}//inner if end
		else {
			header("Location: register.php");
		}	
	}//outer if end

	//Check password
	function checkPassword($pwd) 
	{    
		if (!preg_match("#[A-Za-z]+#", $pwd) || !preg_match("#[0-9]+#", $pwd) || strlen($pwd) < 8) {
			$_SESSION['error'] = "<i>For password use 8 characters or more, having numbers and letters.</i>";
		}
	}
?>
<html>
	<head>
		<title>Running Robot - Register</title>
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
    	
    	<!--div class="tooltip"> Hover
			<span class="tooltiptext">
				Password must have: 
				1-&nbsp;1 Number<br />
				2-&nbsp;1 Uppercase letter<br />
				3-&nbsp;1 Lowercase letter<br />
				4-&nbsp;8 Length <br />
			</span>
		</div-->
		
		<div class="container-fluid">
	        <!--Top Row-->
					
			<!--Registration Section-->
  			<section class="row" >
   				<div class="col-xs-2 col-sm-2 col-md-4 col-lg-4"></div>
   				<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 box">
   					<h4 id="heading">Welcome! Create Account</h4>
   					<hr />
		   			<form action="register.php" method="post">
						<!--Email-->
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-envelope' style='color:green'></span></div>
						    	<input class="form-control" type="text" name="email" value="ab123@mail.com" placeholder="Email address"/>
  							</div>
						</div>
						<!--Password-->
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-lock' style='color:green'></span></div>
						    	<input class="form-control" type="password" name="password" id="newpwd" value="123" onchange="CheckPass()" placeholder="Password"/>
							</div>
						</div>

						<!--Retype Password-->
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-lock' style='color:green'></span></div>
						    	<input class="form-control" type="password" name="password" id="newpwd_retype" value="123" onchange="CheckPass()" placeholder="Retype Password"/>
	  						</div>	  						
						</div>
						<i>For password use 8 characters or more, having numbers and letters</i><br />
						<label id="pwd_msg"></label>
						
						<?php echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';?>
						<br /><br />
						<div class="form-group">
							<div class="input-group">    							
    							<div class="input-group-addon"><span class='glyphicon glyphicon-pencil' style='color:green'></span></div>
						    	<input class="form-control" type="text" id="captcha" name="captcha" placeholder="Enter Captcha Here"/>
  							</div>
						</div>
						<input type="submit" value="Create Account" class="btn btn-success"/>
					</form>
						<?php
							if(isset($_SESSION['error']))
							{
								echo '<h5 style="color:red">'.$_SESSION['error'].'</h5>';
								unset($_SESSION['error']);
							}
						?>
					<hr />
					<a href="login.php">Login</a>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-4 col-lg-4"></div>
  			</section>
		</div>
	</body>
</html>
