<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "Zhan2003", "cap");
	
	if(!$link){
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

?>

												
<?php
	if(isset($_POST['login'])){
			$link = mysqli_connect("localhost", "root", "Zhan2003", "cap");
	
			if(!$link){
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			$e = $_POST['SignInEmail'];
        	$p = $_POST['SignInPassword'];

			$_SESSION['Email']=$e;
	
			$query_login = "SELECT password_hash FROM cap.Authentication WHERE (Email = ?)";
			
			$stat_login = $link->prepare($query_login);
			$stat_login->bind_param('s', $e);
			$stat_login->execute();	
			$stat_login->bind_result($hash);
			$stat_login->fetch();
			$stat_login->close();
			
			//login part
			if(password_verify($p, $hash)){
				$query_user = "SELECT FirstName, LastName, Phone_Num FROM cap.User WHERE (Email = ?)";
				$stat_user = $link->prepare($query_user);
				$stat_user->bind_param('s', $e);
				$stat_user->execute();
			
				$stat_user->bind_result($firstname, $lastname, $phonenumber);
				$stat_user->fetch();
				
				$_SESSION['FirstName'] = $firstname;
				$_SESSION['LastName'] = $lastname;
				$_SESSION['PhoneNumber'] = $phonenumber;
				
				$stat_user->close();
	  			header('Location: http://zcilok.cloudapp.net/capstone/index.php');  
			}

			else{
	    		echo ("<SCRIPT LANGUAGE='JavaScript'>
   					 window.alert('The password is wrong or the account does not exist!')
   					 window.location.href='http://zcilok.cloudapp.net/capstone/index.php';
    				</SCRIPT>");
        	}
	
	}

?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

<head>
	<title>Reserve It</title>
	
	<meta charset="utf-8">
	<meta name="description" content="The Project a Bootstrap-based, Responsive HTML5 Template">
	<meta name="author" content="htmlcoder.me">

	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" href="images/favicon.ico">

	<!-- Web Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Font Awesome CSS -->
	<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- Fontello CSS -->
	<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

	<!-- Plugins -->
	<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
	<link href="plugins/rs-plugin/css/settings.css" rel="stylesheet">
	<link href="css/animations.css" rel="stylesheet">
	<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
	<link href="plugins/hover/hover-min.css" rel="stylesheet">
	
	<!-- the project core CSS file -->
	<link href="css/style.css" rel="stylesheet" >

	<!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
	<link href="css/skins/light_blue.css" rel="stylesheet">

	<!-- Custom css --> 
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet">
	<link href="css/datepicker.css" rel="stylesheet">
	
	<!-- Jquery -->
	<script type="text/javascript" src="plugins/jquery.min.js"></script>
	<!-- Jquery UI -->
	<script type="text/javascript" src="plugins/jquery-ui.min.js"></script>
	<script type="text/javascript" src="plugins/bootstrap-datepicker.js"></script>
	<!-- Bootstrap Validator
	<script type="text/javascript" src="plugins/validator.js"></script> -->

</head>

	<!-- body classes:  -->
	<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
	<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
	<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
	<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
	<body class="no-trans">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
		<!-- header-container start -->
		<!-- ================ -->
		
		<div class="header-container">

				<div class="header-top dark ">
					<div class="container">
						<div class="row">
							<div class="col-xs-3 col-sm-6 col-md-9">

							</div>
							<div class="col-xs-9 col-sm-6 col-md-3">

								<!-- header-top-second start -->
								<!-- ================ -->
								<div id="header-top-second"  class="clearfix">

									<!-- header top dropdowns start -->
									<!-- ================ -->
									<div class="header-top-dropdown text-right">
										<div class="btn-group" id="log">
											<a href="page-signup.php" class="btn btn-default btn-sm" id="sign-up-btn"><i class="fa fa-user pr-10"></i> Sign Up</a>
										</div>
										<div class="btn-group dropdown">
											<button type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown"  id="log-in-btn"><i class="fa fa-lock pr-10"></i> Login</button>
											<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
												<li>
												
													<script>
													<?php
													if(isset($_SESSION['FirstName'])){
														$user = $_SESSION['FirstName'];
														
														echo "$('#log-in-btn').remove();";
														echo "$('#sign-up-btn').remove();";
																						
														echo "var account=\"<a href='dashboard.php' class='btn btn-default btn-sm'>".$user."'s Account</a>\";";
														echo "$('div#log').append(account);";
														echo "var logout=\"<a href='logout.php' class='btn btn-default btn-sm'>Logout</a>\"; ";
														echo "$('div#log').append(logout);";
	
													}
	
													?>
													</script>
													<form action="http://zcilok.cloudapp.net/capstone/index.php" method="POST" class="login-form margin-clear">
														<div class='form-group has-feedback'>
														<label class='control-label'>Email</label>
														<input name="SignInEmail" type="email" class="form-control" placeholder="">
															<i class="fa fa-user form-control-feedback"></i>
														</div>
														<div class="form-group has-feedback">
															<label class="control-label">Password</label>
															<input name="SignInPassword" type="password" class="form-control" placeholder="">
															<i class="fa fa-lock form-control-feedback"></i>
														</div>
														<button name="login" type="submit" class="btn btn-gray btn-sm">Log In</button>
														<ul>
															<li><a href="forget-password.php">Forgot your password?</a></li>
														</ul>

													</form>
												</li>
											</ul>
										</div>
									</div>
									<!--  header top dropdowns end -->
								</div>
								<!-- header-top-second end -->
							</div>
						</div>
					</div>
				</div>
				<!-- header-top end -->
				
				<!-- header start -->
				<!-- classes:  -->
				<!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
				<!-- "dark": dark version of header e.g. class="header dark clearfix" -->
				<!-- "full-width": mandatory class for the full-width menu layout -->
				<!-- "centered": mandatory class for the centered logo layout -->
				<!-- ================ --> 
				<header class="header  fixed   clearfix">
					
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<!-- header-left start -->
								<!-- ================ -->
								<div class="header-left clearfix">

									<!-- logo -->
									<div id="logo" class="logo">
										<a href="index.php"><img id="logo_img" src="images/logo_light_blue.png" width="150px" alt="The Project"></a>
									</div>

									<!-- name-and-slogan -->
									<div class="site-slogan">
										    <p>Reserve It -- Book your parking spot now!</p>
									</div>
									
								</div>
								<!-- header-left end -->

							</div>
							<div class="col-md-9">
					
								<!-- header-right start -->
								<!-- ================ -->
								<div class="header-right clearfix">
									
								<!-- main-navigation start -->
								<!-- classes: -->
								<!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
								<!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
								<!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
								<!-- ================ -->
								<div class="main-navigation  animated with-dropdown-buttons">

									<!-- navbar start -->
									<!-- ================ -->
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">

											<!-- Toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
												
											</div>

											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse" id="navbar-collapse-1">
												<!-- main-menu -->
												<ul class="nav navbar-nav ">

													<!-- mega-menu start -->													
													<li class="mega-menu">
														<a href="search.php">Game Search</a>
													</li>
													<!-- mega-menu end -->

													<li>
														<a href="howitworks.php">How it Works</a>
													</li>

													<li class="">
														<a href="portfolio-grid-2-3-col.html" >About us</a>
													</li>
													<li class="active">
														<a href="index-shop.html">Support</a>
													</li>
													
												</ul>
												<!-- main-menu end -->
												
												<!-- header dropdown buttons -->
												<div class="header-dropdown-buttons hidden-xs ">
													<div class="btn-group dropdown">
														<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i></button>
														<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
															<li>
																<form role="search" class="search-box margin-clear">
																	<div class="form-group has-feedback">
																		<input type="text" class="form-control" placeholder="Search">
																		<i class="icon-search form-control-feedback"></i>
																	</div>
																</form>
															</li>
														</ul>
													</div>

												</div>
												<!-- header dropdown buttons end-->
												
											</div>

										</div>
									</nav>
									<!-- navbar end -->

								</div>
								<!-- main-navigation end -->	
								</div>
								<!-- header-right end -->
					
							</div>
						</div>
					</div>
					
				</header>			
				<!-- header end -->
				<!-- ================ -->
		</div>		

		<!-- header-container end -->
			
			<!-- banner start -->
			<!-- ================ -->
			<div class="dark-bg banner pv-40">
				<div class="container clearfix">

					<!-- slideshow start -->
					<!-- ================ -->
					<div class="slideshow">
						
						<!-- slider revolution start -->
						<!-- ================ -->
						<div class="slider-banner-container">
							<div class="slider-banner-boxedwidth">
								<ul class="slides">
									<!-- slide 1 start -->
									<!-- ================ -->
									<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="">
									
									<!-- main image -->
									<img src="images/title_slide_1.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">
									
									<!-- Transparent Background -->
									<div class="tp-caption dark-translucent-bg"
										data-x="center"
										data-y="bottom"
										data-speed="600"
										data-start="0">
									</div>

									<!-- LAYER NR. 1 -->
									<div class="tp-caption sfb fadeout large_white"
										data-x="left"
										data-y="80"
										data-speed="500"
										data-start="1000"
										data-easing="easeOutQuad">Still <span class="text-default">worry about</span> your parking?
									</div>	

									<!-- LAYER NR. 2 -->
									<div class="tp-caption sfb fadeout large_white tp-resizeme hidden-xs"
										data-x="left"
										data-y="200"
										data-speed="500"
										data-start="1300"
										data-easing="easeOutQuad"><div class="separator-2 light"></div>
									</div>	

									<!-- LAYER NR. 3 -->
									<div class="tp-caption sfb fadeout medium_white hidden-xs"
										data-x="left"
										data-y="220"
										data-speed="500"
										data-start="1300"
										data-easing="easeOutQuad"
										data-endspeed="600">Get your spots reserved now.
									</div>

									<!-- LAYER NR. 4 -->
									<div class="tp-caption sfb fadeout small_white text-center hidden-xs"
										data-x="left"
										data-y="300"
										data-speed="500"
										data-start="1600"
										data-easing="easeOutQuad"
										data-endspeed="600"><a href="#" class="btn btn-default btn-animated">Learn More <i class="fa fa-arrow-right"></i></a>
									</div>

									</li>
									<!-- slide 1 end -->

									<!-- slide 2 start -->
									<!-- ================ -->
									<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
									
									<!-- main image -->
									<img src="images/title_slide_2.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">
									
									<!-- Transparent Background -->
									<div class="tp-caption dark-translucent-bg"
										data-x="center"
										data-y="bottom"
										data-speed="600"
										data-start="0">
									</div>

									<!-- LAYER NR. 1 -->
									<div class="tp-caption sfb fadeout text-right large_white"
										data-x="right"
										data-y="80"
										data-speed="500"
										data-start="1000"
										data-easing="easeOutQuad"><span class="text-default">New</span> Arrivals<br> Unlimited Variations and Layouts
									</div>	

									<!-- LAYER NR. 2 -->
									<div class="tp-caption sfb fadeout large_white tp-resizeme hidden-xs"
										data-x="right"
										data-y="200"
										data-speed="500"
										data-start="1300"
										data-easing="easeOutQuad"><div class="separator-3 light"></div>
									</div>	

									<!-- LAYER NR. 3 -->
									<div class="tp-caption sfb fadeout medium_white text-right hidden-xs"
										data-x="right"
										data-y="220"
										data-speed="500"
										data-start="1300"
										data-easing="easeOutQuad"
										data-endspeed="600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br> Nesciunt, maiores, aliquid.
									</div>

									<!-- LAYER NR. 4 -->
									<div class="tp-caption sfb fadeout small_white text-right text-center hidden-xs"
										data-x="right"
										data-y="300"
										data-speed="500"
										data-start="1600"
										data-easing="easeOutQuad"
										data-endspeed="600"><a href="#" class="btn btn-default btn-animated">Check Now <i class="fa fa-arrow-right"></i></a>
									</div>
									</li>
									<!-- slide 2 end -->
								</ul>
								<div class="tp-bannertimer"></div>
							</div>
						</div>
						<!-- slider revolution end -->

					</div>
					<!-- slideshow end -->

				</div>
			</div>
			<!-- banner end -->
			
			<div id="page-start"></div>

			<!-- section start -->
			<!-- ================ -->
			
			<!-- section end -->

			<!-- section start -->
			<!-- ================ -->
			
			<!-- section end -->

			<!-- section start -->
			<!-- ================ -->
			

			
			
			<!-- footer start (Add "dark" class to #footer in order to enable dark footer) -->
			<!-- ================ -->
			<footer id="footer" class="clearfix dark">

				<!-- .footer start -->
				<!-- ================ -->
				<div class="footer">
					<div class="container">
						<div class="footer-inner">
							<div class="row">
								<div class="col-md-3">
									<div class="footer-content">
										<div class="logo-footer"><img id="logo-footer" src="images/logo_light_blue.png" alt=""></div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus illo vel dolorum soluta consectetur doloribus sit. Delectus non tenetur odit dicta vitae debitis suscipit doloribus. Ipsa, aut voluptas quaerat.</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores similique voluptatum, culpa ad iure sed.</p>
										<div class="icons-block mt-10 mb-10">
											<i class="fa fa-cc-paypal"></i>
											<i class="fa fa-cc-amex"></i>
											<i class="fa fa-cc-discover"></i>
											<i class="fa fa-cc-mastercard"></i>
											<i class="fa fa-cc-visa"></i>
											<i class="fa fa-cc-stripe"></i>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="footer-content">
										<h2 class="title">My Account</h2>
										<div class="separator-2"></div>
										<nav class="mb-20">
											<ul class="nav nav-pills nav-stacked list-style-icons">
												<li><a href="components-social-icons.html"><i class="icon-tools"></i> Settings</a></li>
												<li><a href="components-buttons.html"><i class="icon-search"></i> My Orders</a></li>
												<li><a href="components-buttons.html"><i class="icon-basket-1"></i> Cart</a></li>
												<li><a href="components-forms.html"><i class="icon-heart"></i> Wish List</a></li>
												<li><a href="components-tabs-and-pills.html"><i class="icon-chat"></i> Notifications</a></li>
												<li><a target="_blank" href="http://htmlcoder.me/support"><i class="icon-thumbs-up"></i> Support</a></li>
												<li><a href="#"><i class="icon-lock"></i> Privacy</a></li>
											</ul>
										</nav>
									</div>
								</div>
								<div class="col-md-3">
									<div class="footer-content">
										<h2 class="title">Latest Products</h2>
										<div class="separator-2"></div>
										<div class="row grid-space-10">
											<div class="col-xs-6">
												<div class="overlay-container mb-10">
													<img src="images/product-1.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="overlay-container mb-10">
													<img src="images/product-2.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="overlay-container mb-10">
													<img src="images/product-3.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="overlay-container mb-10">
													<img src="images/product-4.jpg" alt="">
													<a href="portfolio-item.html" class="overlay-link small">
														<i class="fa fa-link"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="footer-content">
										<h2 class="title">Find Us</h2>
										<div class="separator-2"></div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium odio voluptatem necessitatibus illo vel dolorum soluta.</p>
										<ul class="social-links circle animated-effect-1">
											<li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
											<li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
											<li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
											<li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
											<li class="xing"><a target="_blank" href="http://www.xing.com"><i class="fa fa-xing"></i></a></li>
										</ul>
										<div class="separator-2"></div>
										<ul class="list-icons">
											<li><i class="fa fa-map-marker pr-10 text-default"></i> One infinity loop, 54100</li>
											<li><i class="fa fa-phone pr-10 text-default"></i> +00 1234567890</li>
											<li><a href="mailto:info@theproject.com"><i class="fa fa-envelope-o pr-10"></i>info@theproject.com</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .footer end -->

				<!-- .subfooter start -->
				<!-- ================ -->
				<div class="subfooter">
					<div class="container">
						<div class="subfooter-inner">
							<div class="row">
								<div class="col-md-12">
									<p class="text-center">Copyright © 2015 The Project by <a target="_blank" href="http://htmlcoder.me">HtmlCoder</a>. All Rights Reserved</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .subfooter end -->

			</footer>
			<!-- footer end -->
			
		</div>
		<!-- page-wrapper end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster -->
		<!-- ================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- jQuery Revolution Slider  -->
		<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>
		
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		
		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/waypoints/jquery.waypoints.min.js"></script>

		<!-- Count To javascript -->
		<script type="text/javascript" src="plugins/jquery.countTo.js"></script>
		
		<!-- Parallax javascript -->
		<script src="plugins/jquery.parallax-1.1.3.js"></script>

		<!-- Contact form -->
		<script src="plugins/jquery.validate.js"></script>

		<!-- Background Video -->
		<script src="plugins/vide/jquery.vide.js"></script>

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>
		
		<!-- SmoothScroll javascript -->
		<script type="text/javascript" src="plugins/jquery.browser.js"></script>
		<script type="text/javascript" src="plugins/SmoothScroll.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>
		<script> console.dir("<?=$_SESSION['Email']?>");</script>
		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>
		<script src="js/jspdf.js"></script>
		<script>
		<?php
			if(isset($_POST['new_transition'])){
				 $mysqli = new mysqli("localhost", "root", "Zhan2003", "cap");

  //Output any connection error
  if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
  }
  $email=$_SESSION['Email'];
  $sql="select Order_Num from Reservation where User_Email='$email' ORDER BY Order_Date DESC limit 1;";
  $results = $mysqli->query($sql);
  $row=$results->fetch_array();
  if(isset($row)){
    $image_data = $row['Order_Num'];
	$sql="select TeamA,TeamB,Date,P_id,Name,address,FirstName,LastName,price from Reservation as a inner join Event_Buttons as b inner join PKLot as c inner join User as d on a.Button_id=b.B_id and b.PKLot_id=c.P_id and a.User_Email=d.Email where a.Order_Num='$image_data';";
	$results = $mysqli->query($sql);
	$row=$results->fetch_array();
	if(isset($row)){
		$TeamA=$row['TeamA'];
		$TeamB=$row['TeamB'];
		$Date=$row['Date'];
		$P_id=$row['P_id'];
		$Name=$row['Name'];
		$address=$row['address'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$price=$row['price'];
	}
	
  }else{
    echo 'failed';
  }
	
	
	$b64image = base64_encode(file_get_contents("https://api.qrserver.com/v1/create-qr-code/?data=http://zcilok.cloudapp.net/ci/index.php/test/index/".$image_data."&format=jpeg"));
			?>
				
				var content_div = $("<div id='content'> <table id='table_info'><tr><td>NAME:</td><td><?=$FirstName?> <?=$LastName?></td></tr><tr><td>GAME:</td><td><?=$TeamA?> VS <?=$TeamB?></td></tr><tr><td>DATE:</td><td><?=$Date?></td></tr><tr><td>LOCATION:</td><td><?=$address?></td></tr><tr><td>PRICE:</td><td>$<?=$price?></td></tr></table></div>");
				       $(document).ready(function(){ 
            var specialElementHandlers = {
                '#editor': function (element,renderer) {
                    return true;
                }
            };
        
                var doc = new jsPDF('p', 'pt', 'a4');
				
				doc.setFont("helvetica");
				  doc.setFontType("bold");
				  doc.text(40, 50, 'This is your ticket infomation.');
	  
                doc.fromHTML(content_div.html(), 40, 60, {
                    'width': 50,
					'elementHandlers': specialElementHandlers
                });
				
				doc.setFont("helvetica");
				  doc.setFontType("bold");
				  doc.text(40, 270, 'This is your qr code.');
				  
				var show="data:image/jpeg;base64,<?=$b64image?>";
				doc.addImage(show, 'JPEG', 40, 300, 0, 0);
				
				
				
				 var temp = doc.output('datauristring');
				 
				 var pdf=temp.replace('data:application/pdf;base64,','');
				 
				 //pdf=pdf.replace('+','%20');
				  //console.log(pdf);
				  
				

				
				 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      console.log(xhttp.responseText);
    }
  };
  xhttp.open("POST", "http://zcilok.cloudapp.net/ci/index.php/pdfprocess/createPdf", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("pdf="+pdf+"&email=<?=$email?>");
console.log("<?=$email?>  <?=$image_data?>");
			


        
        
		
		
		
		});
	  
	
	  
	
		<?php
			}
		?>
		</script>
	</body>
</html>
