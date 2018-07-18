<?php 
if($_SERVER["REQUEST_METHOD"]== "POST")
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];

	$mail_msg = "<br/>Name: ".$name."<br/>Email: ".$email."<br/><br/>Message: ".$msg."<br/><br/>";

	echo $mail_msg;
	// send email
    mail("RR@abc.com","RR - Contact Form",$mail_msg);
}//outer most if end

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Running Robot</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  
  <!--link rel="stylesheet" href="lib/fontsawesome_v5.0.13.css" />
  <link rel="stylesheet" href="lib/bootstrap.min.css" />
  <script src="lib/jquery-3.1.1.min.js"></script>
  <script src="lib/popper.min.js"></script>
  <script src="lib/bootstrap.min.js"></script-->
  <link rel="stylesheet" href="style/style.css" />
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="index.html"><i class="fa fa-home"></i>&nbsp;Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="contact.php"><i class="fa fa-envelope"></i>&nbsp;Contact</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="levels.html"><i class="fa fa-level-up-alt"></i>&nbsp;Levels</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="garage.html"><i class="fa fa-robot"></i>&nbsp;Garage</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="account/register.php"><i class="fa fa-sign-in-alt"></i>&nbsp;Register</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="account/login.php"><i class="fa fa-user"></i>&nbsp;Login</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <section class="row">
   	<div class="col-xs-0 col-sm-1 col-md-3 col-lg-3"></div>
   	<div class="col-xs-12 col-sm-10 col-md-6 col-lg-6">
   		<h6 class="font-huge center main">Contact Us<br/><span class="font-normal text">Send us your feedback and report bugs</span></h6>
   		<form action="contact.php" method="post">
			<div class="form-group">
				<label for="username" class="font-normal input_form"><strong><i class="fa fa-user main"></i>&nbsp;NAME:</strong></label>
				<input type="text" class="form-control input_form" id="username" name="name" required>
			</div>
			<div class="form-group">
				<label for="inputemail input_form" class="font-normal"><strong><i class="fa fa-envelope main"></i>&nbsp;EMAIL:</strong></label>
				<input type="email" class="form-control input_form" id="inputemail" name="email"  required>
				<div class="invalid-feedback">
		    		  Please provide a valid Email.
        		</div>
    		</div>
			<div class="form-group">
	 			<label for="message" class="font-normal"><strong><i class="fa fa-comment-alt main"></i>&nbsp;Message:</label>
  	  			<textarea class="form-control" rows="7" id="message" name="msg" required></textarea>
			</div>	
			<button type="submit" class="btn btn-default font-normal" style="background-color:#33EE33;color:#9900FF;"><strong>Submit</strong></button>
		</form>
	</div>
	<div class="col-xs-0 col-sm-1 col-md-3 col-lg-3"></div>

  </section>
</div>
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
</html>
