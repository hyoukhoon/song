<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

?>
<!DOCTYPE HTML>
<html>
<head>
<title>seeds song</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
<!-- //bootstrap -->
<link href="css/dashboard.css" rel="stylesheet">
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
<script src="js/jquery-1.11.1.min.js"></script>
<!--start-smoth-scrolling-->
<!-- fonts -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<!-- //fonts -->
</head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Seeds Song</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<div class="top-search">
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
					<input type="submit" value=" ">
				</form>
			</div>
			<div class="header-top-right">
				<div class="signin">
					<a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Sign Up</a>
					<!-- pop-up-box -->
									<script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
									<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
									<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
									<!--//pop-up-box -->
									<div id="small-dialog2" class="mfp-hide">
										<h3>Create Account</h3> 
										<div class="social-sits">
											<div class="facebook-button">
												<a href="#">Connect with Facebook</a>
											</div>
											<div class="chrome-button">
												<a href="#">Connect with Google</a>
											</div>
											<div class="button-bottom">
												<p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
											</div>
										</div>
										<div class="signup">
											<form>
												<input type="text" class="email" placeholder="Email" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid Email" />
											</form>
											<div class="continue-button">
												<a href="#small-dialog3" class="hvr-shutter-out-horizontal play-icon popup-with-zoom-anim">CONTINUE</a>
											</div>
										</div>
										<div class="clearfix"> </div>
									</div>	
									<div id="small-dialog3" class="mfp-hide">
										<h3>Create Account</h3> 
										<div class="social-sits">
											<div class="facebook-button">
												<a href="#">Connect with Facebook</a>
											</div>
											<div class="chrome-button">
												<a href="#">Connect with Google</a>
											</div>
											<div class="button-bottom">
												<p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
											</div>
										</div>
										<div class="signup">
											<form>
												<input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
												<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
												<input type="text" class="email" placeholder="Mobile Number" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid mobile number" />
												<input type="submit"  value="Sign Up"/>
											</form>
										</div>
										<div class="clearfix"> </div>
									</div>	
									<div id="small-dialog7" class="mfp-hide">
										<h3>Create Account</h3> 
										<div class="social-sits">
											<div class="facebook-button">
												<a href="#">Connect with Facebook</a>
											</div>
											<div class="chrome-button">
												<a href="#">Connect with Google</a>
											</div>
											<div class="button-bottom">
												<p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
											</div>
										</div>
										<div class="signup">
											<form action="upload.html">
												<input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
												<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
												<input type="submit"  value="Sign In"/>
											</form>
										</div>
										<div class="clearfix"> </div>
									</div>		
									<div id="small-dialog4" class="mfp-hide">
										<h3>Feedback</h3> 
										<div class="feedback-grids">
											<div class="feedback-grid">
												<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											</div>
											<div class="button-bottom">
												<p><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign in</a> to get started.</p>
											</div>
										</div>
									</div>
									<div id="small-dialog5" class="mfp-hide">
										<h3>Help</h3> 
											<div class="help-grid">
												<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											</div>
											<div class="help-grids">
												<div class="help-button-bottom">
													<p><a href="#small-dialog4" class="play-icon popup-with-zoom-anim">Feedback</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Lorem ipsum dolor sit amet</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Nunc vitae rutrum enim</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris at volutpat leo</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris vehicula rutrum velit</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Aliquam eget ante non orci fac</a></p>
												</div>
											</div>
									</div>
									<div id="small-dialog6" class="mfp-hide">
										<div class="video-information-text">
											<h4>Video information & settings</h4>
											<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											<ol>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
											</ol>
										</div>
									</div>
									<script>
											$(document).ready(function() {
											$('.popup-with-zoom-anim').magnificPopup({
												type: 'inline',
												fixedContentPos: false,
												fixedBgPos: true,
												overflowY: 'auto',
												closeBtnInside: true,
												preloader: false,
												midClick: true,
												removalDelay: 300,
												mainClass: 'my-mfp-zoom-in'
											});
																											
											});
									</script>	
				</div>
				<div class="signin">
					<a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a>
					<div id="small-dialog" class="mfp-hide">
						<h3>Login</h3>
						<div class="social-sits">
							<div class="facebook-button">
								<a href="#">Connect with Facebook</a>
							</div>
							<div class="chrome-button">
								<a href="#">Connect with Google</a>
							</div>
							<div class="button-bottom">
								<p>New account? <a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Signup</a></p>
							</div>
						</div>
						<div class="signup">
							<form>
								<input type="text" class="email" placeholder="Enter email / mobile" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?"/>
								<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
								<input type="submit"  value="LOGIN"/>
							</form>
							<div class="forgot">
								<a href="#">Forgot password ?</a>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
        </div>
		<div class="clearfix"> </div>
      </div>
    </nav>
	
        <div class="col-sm-3 col-md-2 sidebar">
			<div class="top-navigation">
				<div class="t-menu">MENU</div>
				<div class="t-img">
					<img src="images/lines.png" alt="" />
				</div>
				<div class="clearfix"> </div>
			</div>
				<div class="drop-navigation drop-navigation">
				  <ul class="nav nav-sidebar">
					<li class="active"><a href="index.html" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
					<li><a href="shows.html" class="user-icon"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>발라드</a></li>
					<li><a href="history.html" class="sub-icon"><span class="glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>힙합</a></li>
					<!-- <li><a href="#" class="menu1"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>Movies<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
						<ul class="cl-effect-2">
							<li><a href="movies.html">English</a></li>                                             
							<li><a href="movies.html">Chinese</a></li>
							<li><a href="movies.html">Hindi</a></li> 
						</ul> -->
						<!-- script-for-menu -->
						<script>
							$( "li a.menu1" ).click(function() {
							$( "ul.cl-effect-2" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<!-- <li><a href="#" class="menu"><span class="glyphicon glyphicon-film glyphicon-king" aria-hidden="true"></span>Sports<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
						<ul class="cl-effect-1">
							<li><a href="sports.html">Football</a></li>                                             
							<li><a href="sports.html">Cricket</a></li>
							<li><a href="sports.html">Tennis</a></li> 
							<li><a href="sports.html">Shattil</a></li>  
						</ul> -->
						<!-- script-for-menu -->
						<script>
							$( "li a.menu" ).click(function() {
							$( "ul.cl-effect-1" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<li><a href="movies.html" class="song-icon"><span class="glyphicon glyphicon-music" aria-hidden="true"></span>댄스</a></li>
					<li><a href="news.html" class="news-icon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>락</a></li>
				  </ul>
				  <!-- script-for-menu -->
						<script>
							$( ".top-navigation" ).click(function() {
							$( ".drop-navigation" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					
				</div>
        </div>