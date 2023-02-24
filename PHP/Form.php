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
  <?php session_start();

   $fullname = $_POST['full_name'];
   $email = $_POST['email'];
   $interest = $_POST['check-1'].' '.$_POST['check-2'].' '.$_POST['check-3'];
   $subject = $_POST['subject'];
   $message = $_POST['message'];

   $db_host="localhost";
   $db_username="testuser";
   $db_passwd="password";

         
   $dbc=mysqli_connect('localhost','testuser','password','TENK_Computers') or die ("Could not Connect! \n");

   $sql = "INSERT INTO feedback VALUES ('$fullname','$email','$interest','$subject','$message');";
	
   $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");


   mysqli_close();



 
  ?>


 
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
				<li><a href="buy.php">Buy</a></li>
				<li><a href="information.php">Information</a></li>
				<li class="current"><a href="Form.html">Feedback</a></li>
                                <?php
                                   $loggedin=$_SESSION["logged"];
                                   $access = $_SESSION["premissions"];
                                   if ($loggedin == 1)
                                    {
                                     ?>	
                       		     <li><a href="logout.php">Logout</a></li>
                                     <!-- <button class="button_1" style="position: relative; bottom: 10px;>Logout</button>-->
                                     <?php 
                                     if ($access == 'admin')
                                      {
                                       ?>
                                       <li><a href="addproducts.php">Admin</a></li>
                                       <?php 
                                      }
                                     }else{  
                                     ?>                                  
				     <li><a href="login.php">Login</a></li>
                                     <?php
                                      }
                                      ?> 
				<li><a href="about.php">About Us</a></li>
			</ul>
		</nav>
		</div>
	</header>
	
	<section id="form-section">
		<div class="contact-title">
			<h1>What's On Your Mind</h1>
			<h2>We Are Always Currious To Know</h2>
		</div>
	
		<div class="contact-form">
			<form id="contact-form" method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				
				<input id="name" type="text" class="form-control" placeholder="Your Name" required name="full_name"><br>
				<label class="error" class= "form-control" for="name" id="name_error"><br>Name must contains no number or special characters<br></label>
				
				<input id="email" type="email" class="form-control" placeholder="Your Email" required  name="email"><br>
				<label class="error" class ="form-control" for="email" id="email_error"><br>Invalid email<br></label>
				
				<div class="checkboxes">
					<label for="form">Interested In</label>
					<input type="checkbox" id="check1" name="check-1" value="BuildPC">
					<label for="check1">Build PC</label>
					<input type="checkbox" id="check2" name="check-2" value="ComputerParts" >
					<label for="check2">Buy Computer Parts</label>
					<input type="checkbox" id="check3" name="check-3" value="PC/Laptop" >
					<label for="check3">PC/Laptop Repair</label>
					<label class="error" for="email" id="checkbox_error"><br><br>Must check at least one box<br></label>
				</div>
				
				<input id="subject" type="subject" class="form-control" placeholder="Subject Of Your Message" required name="subject"><br>
				<textarea name="message" class="form-control" placeholder="Message" rows="5" required ></textarea><br>
				
				<input type="submit" class="form-control submit" id="button" value="SEND FEEDBACK">
				
			</form>
		</div>
	</section>

	<footer>
		<p>Tenk Computers Design, Copyright &copy 2019</p>
	</footer>
	
</body>

</html>
