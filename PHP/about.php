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
	
	<title>Web Design | About </title>
	<!-- linking css -->
	<link rel ="stylesheet" href="CSS/web.css">
	
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
				<li><a href="buy.php">Buy</a></li>
				<li><a href="information.php">Information</a></li>
				<li><a href="Form.php">Feedback</a></li>
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
                                       <li class = "current"><a href="addproducts.php">Admin</a></li>                                      
<?php 
                                      }
                                     }else{  
                                     ?>                                  
				     <li><a href="login.php">Login</a></li>
                                     <?php
                                      }
                                      ?> 
				<li><a href="about.html">About Us</a></li>
			</ul>
		</nav>
		</div>
	</header>

	
	<section id="newsletter">
		<div class="container">
			<h1> Subscribe For Great Deals </h1>
			
			<form>
			<input type="email" placeholder="Enter Email...">
			<button type="submit" class="button_1">Subscribe</button>
			</form>
		</div>
	</section>
	
	<section id="main">
		<div class="container">
			<!-- article is html semantic tag -->
		<article id="main-col">
			<h1 class="page-title">About Us</h1>
			<p>
			We are four students who share the same background as Computer Engineer. Here are our founders
			</p>
			
	
			<img class="ava" src="./Images/trung.jpg" ></img>
			<h3> Trinh Quang Trung </h3>
			<p>My name is Trinh Quang Trung, I'm originally from Hanoi Vietnam. I'm a second year student in Computer Engineer Technology in Humber College. I'm software and website developer enthusiast
			</p>
			
			<img class="ava" src="./Images/emmanuel.jpg" ></img>
			<h3> Emmanuel Umeh </h3>
			<p>
			My name is Emmanuel Umeh am currently a student of Humber college studying Computer Engineering. From when i was young i have always loved computers and building one was my goal. I also pay
			attention to the lastest technology trendys and topics.
			</p>
			
			<img class="ava" src="./Images/Nick.jpg" ></img>
			<h3> Nicolas Vincent Robert Cristiano </h3>
			<p>
			My name is Nicolas Vincent Robert Cristiano. I am a Computer Engineering student currently in my third year at Humber College. Someday when I'm older I aspire to either be a computer programmer, graphic designer or web designer.
			</p>
			
			<img class="ava" src="./Images/kyle.jpg" ></img>
			<h3> Kyle Voduris</h3>
			<p>
			My name is Kyle and I am currently 19 years old and I am studying Computer Engineering at Humber College.
			I have been studying there since 2017. I am currently living in Brampton, Ontario, Canada. I was born on June 17, 1999.
			</p>
				</article>
				
		<!-- Making a sidebar -->
			<aside id="sidebar">	
			  <div class="dark">
				<h3>What we do </h3>
				<p>We a group of enthusiastic programmers who decided to make PC based website due to our love for computers and technology. We work steadfastly
					to ensure the tech we sell is up to date and verified from our various manufacturers. We understand what our customers want because we have
					been in the perspective of our customers before which gives us an advantage in terms of customer satisfaction. We are based at Humber College
					and operate on a timely base to update our catalogue of new and better items to be sold. We hope you can support what we do due to our work ethic
					and joy for computers.
				</p>
				</div>
			</aside>
			
		</div>
	</section>

	<footer>
		<p>Tenk Computers Design, Copyright &copy 2019</p>
	</footer>
</body>

</html>
