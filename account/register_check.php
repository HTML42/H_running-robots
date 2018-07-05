<?php
/*This page creates new account if captacha is correct*/
include '../model/db_con.php';
session_start();
	
	if($_SERVER["REQUEST_METHOD"]== "POST")
	{
		//echo $captcha.'-'.$_SESSION['captcha']['code'];
		if(addslashes($_POST['captcha']) == $_SESSION['captcha']['code'] || 1==1)//Add trip if captcha is correct, to protect against bots
		{
			echo "1-";
			
			if($_POST['email'] == '')
			{
				echo "E-mail is required.";
			}
			else
			{
				//whether the email format is correct
				if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email']))
				{
					//if it has the correct format whether the email has already exist
					$email=addslashes($_POST['email']);
					$sql1 = "SELECT * FROM Login WHERE email = '$email'";
					$result1 = mysqli_query($link,$sql1) or die(mysqli_error());
					if (mysqli_num_rows($result1) > 0)
					{
						echo "<script>alert('This Email is already used.')</script>";
					}
				}
				else
				{
					//this error will set if the email format is not correct
					echo "<script>alert('Your email is not valid.')</script>";
				}
			}
			
			//$email=addslashes($_POST['email']);
			$password=addslashes($_POST['password']);
			$code=0;
			$options = [
			  'cost' => 12
			];
			
			echo "2-";
			
			$password=password_hash($password, PASSWORD_BCRYPT, $options);//hash password

			echo "3-";
			
			$stmt = $link->prepare("insert into Login (email,password,code) VALUES (?,?,?)");
			
			echo "4-";
			
			$stmt->bind_param("ssi",$email,$password,$code);
echo "5-";
			if($stmt->execute())
			{
				//$_SESSION['login_user']=$email;
				//$_SESSION['cdid']=$cdid;
			//	header("Location: login.php");
				//echo "Trip created";
			}
			else
			{
				//$error="your login name or password is invalid";
			}	
		}//inner if end
		else {
			header("Location: register.php");
		}	
	}//outer if end
?>
