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
			$stat_login->bind_result($login_hash);
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
		<title>Reserve It | Password Reset</title>
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
                            <a href="#">Parking Map</a>
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

    <!-- breadcrumb start -->
      <!-- ================ -->
      <div class="breadcrumb-container">
        <div class="container">
          <ol class="breadcrumb">
            <li><i class="fa fa-home pr-10"></i><a href="index.php">Home</a></li>
            <li class="active">Password Reset</li>
          </ol>
        </div>
      </div>
      <!-- breadcrumb end -->


      		<section class="main-container padding-bottom-clear">
      		<div class="container">
      			<div class="row">
					We are processing you order. You would be redirected to home page within <span id="totalSecond">10</span> second.
      			</div>
                <form id='form_transition' action="index.php" method="post">
  <input type="hidden" name="new_transition" value="1">
</form>
      		</div>
      		</section>

      		<!-- main-container end -->

      		<br><br><br><br><br><br><br>
      				<!-- .subfooter start -->
      				<!-- ================ -->
      				
                	<!-- .subfooter end -->

      			</footer>
      			<!-- footer end -->

      		</div>
      		<!-- page-wrapper end -->


      		<!-- JavaScript files placed at the end of the document so the pages load faster -->
      		<!-- ================================================== -->
      		<!-- Jquery and Bootstap core js files -->
      		<!--<script type="text/javascript" src="plugins/jquery.min.js"></script>-->
      		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

      		<!-- Modernizr javascript -->
      		<script type="text/javascript" src="plugins/modernizr.js"></script>

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

      		<!-- Custom Scripts -->
      		<script type="text/javascript" src="js/custom.js"></script>
			
			<script language="javascript" type="text/javascript"> 
var second = document.getElementById('totalSecond').textContent; 
 
if (navigator.appName.indexOf("Explorer") > -1)  { 
    second = document.getElementById('totalSecond').innerText; 
} else { 
    second = document.getElementById('totalSecond').textContent; 
} 
 
 var id;
id=setInterval("redirect()", 1000); 
function redirect() { 
if (second < 0) {
    $('#form_transition').submit();
    console.log('asdfa');
    clearInterval(id);
    
} else { 
    if (navigator.appName.indexOf("Explorer") > -1) { 
        document.getElementById('totalSecond').innerText = second--; 
    } else { 
        document.getElementById('totalSecond').textContent = second--; 
    } 
} 
} 
</script>
      	</body>
      </html>
