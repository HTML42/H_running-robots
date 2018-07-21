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
  
  <script>
  	var new_user="",id;
  	var flag_add=false;
  	$.getJSON("model/Getdata_dashboard.php",function(result){
		result=result['player']['info'];
		var name,levels,coin, gold;
		//if data of user is not entered yet or name is missing
		if(result.length==0 || result[0]['name']=="")
		{
			while(1==1)//ask name of player untill name is entered
			{
				new_user=prompt("Welcome New User!\nPlease Provide Your Name Once\nIt will be used as your in during game. Thank You");
				if(new_user==null || new_user=="")
				{
					continue;//nothing entered prompt again
				}
				//Get Player id
				$.getJSON("model/Getdata_Player.php",function(result){
					var result=result['info'];
					Player_id= result[0]['id'];
					//Add Player
					$.getJSON("model/AddPlayer.php",{user:new_user,id:Player_id},function(result){
						
					});//AddPlayer end
				});//Getdata_Player end
				flag_add=true;
						
				break;	
				
			}//while end			
		}//outer if end
		if(!flag_add)
		{
			name= $("<h6><strong>Name: </strong>"+result[0]['name'].charAt(0).toUpperCase() + result[0]['name'].substr(1)+"</h6>");
			levels= $("<h6><strong>Level: </strong>"+result[0]['levels']+"</h6>");
			coin= $("<h6><strong>Coins: </strong>"+result[0]['coin']+"</h6>");	
			gold= $("<h6><strong>Gold: </strong>"+result[0]['gold']+"</h6>");	
		}
		else{
			name= $("<h6><strong>Name: </strong>"+new_user.charAt(0).toUpperCase() + new_user.substr(1)+"</h6>");
					levels= $("<h6><strong>Level: </strong>0</h6>");
					coin= $("<h6><strong>Coins: </strong>0</h6>");	
					gold= $("<h6><strong>Gold: </strong>0</h6>");	
					
		}
		
				
		var box = $("<div class='box'></div><br/>");
		box.append(name);
		box.append(levels);
		box.append(coin);
		box.append(gold);
				
		$("#info").append(box);			
		
	}).done(function(d){
		//alert("sucess");
	}).fail(function(d,textStatus,error){
		//alert("getJSON failed, status:"+textStatus+", error: "+error)
	}).always(function(d){
		//alert("complete");
	});
  </script>
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

<!--BODY ------------------------------->
<div class="container-fluid">
  <section class="row">
  	<div class="col-xs-0 col-sm-1 col-md-2 col-lg-2"></div>
   	<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8">
   		<h6 class="font-huge center main">Welcome to Your Dashboard</h6>
   	</div>
   	<div class="col-xs-0 col-sm-1 col-md-2 col-lg-2"></div>
  </section>
  <section class="row">
   	<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1"></div>
   	<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 dashboard_box">
   		<h3 class="font-big secondary">Profile</h3>
   		<hr />
		<div id="info"></div>
		<ul>
			<li>Level 1 = Very Easy</li>
			<li>Level 2 = Easy</li>
			<li>Level 3 = Medium</li>
			<li>Level 4 = Hard</li>
			<li>Level 5 = Very Hard</li>
			<li>Level 6 = Expert</li>
		</ul>
	</div>
	<div class="col-xs-0 col-sm-2 col-md-2 col-lg-2"></div>
	<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 dashboard_box">
   		<h3 class="font-big secondary">Currencies</h3>
   		<hr />
		<p class="font-normal text">Gold can be bought for money in the shop. <br/>Prices:</p>
		<ul>
			<li>0.99€ = 9 Gold</li>
			<li>1.99€ = 20 Gold</li>
			<li>4.99€ = 60 Gold</li>
			<li>9.99€ = 150 Gold</li>
			<li>29.99€ = 500 Gold</li>
		</ul>
		<a class="btn btn-primary" href="shop.html" style="float: right"><i class="fa fa-shopping-bag"></i>&nbsp;Buy Now</a>
		<br /><br />
	</div>
	<div class="col-xs-0 col-sm-0 col-md-1 col-lg-1"></div>
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
