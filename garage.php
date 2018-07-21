<?php 
	include 'model/dbcon.php';
	include('account/lock.php');
	session_start();
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
  <style>
  	body{
  		background-image: url('img/garage.jpg');
		background-size: 100% 100%;
		background-attachment: fixed;
		background-repeat: no-repeat;
		width: 100%;
		height: 100%;
  	}
  	.myrobo{
  		border-top: 5px solid #9900FF;
  		border-right: 2px solid #9900FF;
  		border-left: 2px solid #33EE33;
  		border-bottom: 5px solid #33EE33; 
  		border-radius:10px;
  		padding:5px;
  	}
  	.myrobo:hover{
  		border-top: 10px solid #9900FF;
  		border-right: 7px solid #9900FF;
  		border-left: 7px solid #33EE33;
  		border-bottom: 10px solid #33EE33; 
  		border-radius:10px;
  		padding:5px;
  	}
  </style>
</head>
<body>

	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    	<a class="navbar-brand logo" href="index.html" ><strong>R-R</strong></a>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
            	<li class="nav-item active">
    				<a class="nav-link" href="dashboard.php"><i class="fa fa-object-group"></i>&nbsp;Dashboard</a>
    			</li>
    			<li class="nav-item active">
    				<a class="nav-link" href="levels.php"><i class="fa fa-level-up-alt"></i>&nbsp;Levels</a>
    			</li>
    			<li class="nav-item active">
      				<a class="nav-link" href="garage.php"><i class="fa fa-robot"></i>&nbsp;Garage</a>
			    </li>
    			<li class="nav-item active">
      				<a class="nav-link" href="shop.html"><i class="fa fa-shopping-bag"></i>&nbsp;Shop</a>
			    </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active">
      				<a class="nav-link" href="account/logout.php"><i class="fa fa-sign-out-alt"></i>&nbsp;Logout</a>
				</li>
            </ul>
        </div>
	</nav>

<div class="container-fluid">
  <section class="row">
   	<div class="col-xs-0 col-sm-1 col-md-3 col-lg-3"></div>
   	<div class="col-xs-12 col-sm-10 col-md-6 col-lg-6">
   		<h1 class="font-huge center main">My Robots</h1>
	</div>
	<div class="col-xs-0 col-sm-1 col-md-3 col-lg-3"></div>
  </section>
  <section class="row">
   	<div class="col-xs-0 col-sm-0 col-md-2 col-lg-3"></div>
   	<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
   		<img class="myrobo" src="img/r2.png" />
   	</div>
   	<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
   		<img class="myrobo" src="img/r1.png" />
	</div>
	<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
   		<img class="myrobo" src="img/r2.png" />
	</div>
	<div class="col-xs-0 col-sm-0 col-md-1 col-lg-3"></div>
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
