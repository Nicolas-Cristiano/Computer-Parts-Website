<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<!-- make content viewable by any devices -->
	<meta name="viewport" content="width=device=width">
	
	<!-- What does these codes do ? scl ?? -->
	<meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and professional web design">
	<meta name="keywords" content="web design, affordable web design, professional web design">
  	<meta name="author" content="Quang Trung Trinh">
	
	<title>Web Design | Login </title>
	<!-- linking css -->
	<link rel ="stylesheet" href="CSS/web.css">
		<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>
		<script src="./JS/form.js"> </script>
	
</head>

<body>
   <?php session_start(); ?>

	<!-- refers segmantic tag, header is the
		header of the page -->
	<header>
		<!-- class container is used for styling in css -->
		<div class="container">
			<div id="branding">
				<!-- This way we can isolate "Trung" for
				styling and still in the same line with 
					the header -->
				<h1><span class="highlight"> TENK </span> Computers </h1>
		</div>
		
			<!-- everything in nav tag is linking a 
				elements to links -->
		<nav>
			<ul> 
				<li><a href="web.php">Home</a></li>
				<li><a href="information.html">Information</a></li>
				<li><a href="Form.html">Feedback</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="about.html">About Us</a></li>
			</ul>
		</nav>
		</div>
	</header>

	<div class="containerr">
	<img name="slide" src="./Images/pic2.jpg" style="width:100%;height:950px;">
	<div class="thanks">
                        <h1>Login Successful !</h1>
			<h1>Welcome <?php $name=$_SESSION["username"]; echo $name;?></h1>
                        <h1>You will be redirected to the homepage in 5 seconds</h1>
                        <?php header( "refresh:5;url=web.php");?>

		</div>
	</div>

	<footer>
		<p>Tenk Computers Design, Copyright &copy 2019</p>
	</footer>
	
</body>

</html>
