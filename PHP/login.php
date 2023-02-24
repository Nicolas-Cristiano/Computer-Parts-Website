<html>
<head>
<title>Login Page</title>
<link rel ="stylesheet" href="CSS/login.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
</script>
<script src="./JS/login_validation.js"> </script>   

</head>
	
<body>

<?php
     session_start();

     $out_message = "";
     $nameErr = $emailErr = $passErr;
     $name = $email = $pass;

     if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
       if(empty($_POST["name"]))
        {
         $nameErr = "Name is required";
         }
          else
           {
            $name = test_input($_POST["name"]);
	    if (!preg_match("/^[a-zA-Z0-9]*$/",$name))
             { 
	       $nameErr="Must contain only letters and white spaces";
	      }
             }
           if(!empty($_POST["password"]))
             {
              $pass = test_input($_POST["password"]);
              if (strlen($_POST["password"]) < 8)
              {
                $passErr ="Must be greater than 8 characters"; 
              } 
             else if(!preg_match("#[0-9]+#",$pass))
              {
 	       $passErr ="must contain 1 number!";
              }
              else if(!preg_match("#[A-Z]+#",$pass))
              {
 	       $passErr ="Must contain capital";
              }
             else if(!preg_match("#[a-z]+#",$pass))
              {
 	       $passErr ="Your Password Must Contain At Least 1 Lowercase Letter";
              }
             else if(!preg_match("/[!$]/",$pass))
              {
 	       $passErr ="Your Password Must Contain A Special Character";
              }  
             }
           else 
            {
             $passErr = "Please enter password";
            }
           if(empty($_POST["email"]))
            {
             $emailErr = "Email is required";
            }
           else
            {
             $email = test_input($_POST["email"]);
            }

          if ($nameErr ==""&& $emailErr ==""&& $passErr =="")
            {
         
            $db_host="localhost";
            $db_username="testuser";
            $db_passwd="password";
	    
 	    $dbc=mysqli_connect('localhost','testuser','password','TENK_Computers')
	    or die ("Could not Connect! \n");
       
            $sql="SELECT salt FROM login WHERE username = '$name';";
                  
        if ($result=mysqli_query($dbc,$sql))
         {
         // Fetch one and one row
         while ($row=mysqli_fetch_row($result))
         {
          $salt=$row[0];
         }      
	}
   
        $passsalt = ($salt.$pass);
        $hashed=hash('sha256',$passsalt);
        
        $sql = "SELECT * FROM login WHERE hash = '$hashed' AND email = '$email' AND username = '$name'";
        $result = mysqli_query($dbc,$sql) or die ("Error Querying Database");

   
         if (mysqli_num_rows($result) > 0 ) 
          {
           $_SESSION["logged"] = 1;
           $_SESSION["username"] = $name;

           $sql = "SELECT access FROM login Where username = '$name';";
           if ($result=mysqli_query($dbc,$sql))
            {
             while ($row=mysqli_fetch_row($result))
              {
               $access=$row[0];
              }             
             }

            $_SESSION["premissions"] = $access;          
            $out_message = "Login successful";
            header('Location: /project/thank.php'); 

         }
         else 
          { 
           ?>
           <script>
           //console.log("Test");
           alert("Login unsuccessful please try again.");
           </script>
           <?php         
           $out_message = "Login unsuccessful please try again.";
          }          
          mysqli_close();

            } 
      }

     
                function test_input($data)
                 {
		  $data=trim ($data); 
		  $data=stripslashes($data); 
		  $data=htmlspecialchars($data); 
                  return $data;
	         }

?>

<!--	header of the page -->
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
				<li class="current"><a href="login.php">Login</a></li>
				<li><a href="about.php">About Us</a></li>
			</ul>
		</nav>
		</div>
	</header>
	
	<section class ="logbg" id="login-section">
		<div class="regbox">
			<h2>Login</h2>
		    
			<form name="registration" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                             

				<div class="textbox">
					<label for="name">Username</label>
					<i class="fas fa-user" id="usericon"></i>
					<input type="text" name="name" id="name" placeholder="AlexSmith123"/>
				</div>
				
				<div class="login_error">
					<label class="error" id="nameerror">Username is required!</label>
					<label class="error" id="namenumber">Username can only contain letters and numbers!</label>
				</div>

				<div class="textbox">
					<label for="email">Email</label>
					<i class="fas fa-envelope"></i>
					<input type="email" name="email" id="email" placeholder="alex_smith@email.com"/>
				</div>
				
				<div class="login_error">
					<label class="error" id="emailerror">Email is required!</label>
				</div>


				<div class="textbox">
					<label for="password">Password</label>
					<i class="fas fa-lock"></i>
					<input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"/>
				</div>
				
				<div class="login_error">
					<label class="error" id="passworderror">Password is required!</label>
					<label class="error" id="passwordlength">The password must be at least 8 characters long!</label>
					<label class="error" id="passwordcharacters">Password Must Contain At least 1 letter, 1 number and a special character!</label>
				</div>
				
				<button class="button2" type="submit">Login</button>

			</form>  
                  	<a href="registration.php">Don't have an account? Click here to register!</a> 
		</div>
	</section>


	<footer id ="login">
		<p>Tenk Computers, Copyright &copy 2019</p>
	</footer>

</body>
</html>
