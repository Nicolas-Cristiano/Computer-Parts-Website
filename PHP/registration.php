<html>
<head>
<title>Registration</title>
<link rel ="stylesheet" href="CSS/login.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js">
</script>
<script src="./JS/register_validation.js"> </script> 
</head>
<body>
<?php
	$nameErr = $emailErr = $passErr = $repassErr= "";
	$name = $email = $pass = $repass = "";
        $access = "user";

         if ($_SERVER["REQUEST_METHOD"] == "POST")
          {
           if(empty($_POST["username"]))
            {
             $nameErr = "Name is required";
            }
           else
            {
             $name = test_input($_POST["username"]);
	     if (!preg_match("/^[a-zA-Z0-9]*$/",$name))
              { 
		$nameErr="Must contain only letters and numbers.";
	      }
             }

            if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["repassword"]))
             {
              $pass = test_input($_POST["password"]);
              $repass = test_input($_POST["repassword"]);

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
            elseif(!empty($_POST["password"]))
            {
             $pass = test_input($_POST["password"]);
             $repassErr = "Please Check You've Entered Or Confirmed Your Password!";
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
         
          /* 
          if(empty($_POST["access"]))
            {
             $accessErr = "Access is required";
            }
           else
            {
             $access = test_input($_POST['access']);
            }
          */        
 
           if ($nameErr ==""&& $emailErr ==""&& $passErr ==""&& $repassErr =="")
            {
	     $db_host="localhost";
             $db_username="testuser";
	     $db_passwd="password";

             $dbc=mysqli_connect('localhost','testuser','password','TENK_Computers')
	     or die ("Could not Connect! \n");
             
             $salt = uniqid(mt_rand(), true);
             $passsalt = ($salt.$pass);
             $hashed=hash('sha256',$passsalt);
	     $sql="INSERT INTO login VALUES (NULL,'$email','$access','$hashed','$salt','$name');";
	
	     $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

	     mysqli_close();
      
             header('Location: /project/web.php');
            
             
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
<h2>Registration</h2>

<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post" >

<div class="textbox">
<label for="username">Username:</label>
<input type="text" id="username" name="username" placeholder = "Alexsmith123" value="<?php echo $name;?>" />
</div>

<div class="login_error">
<!--<span class="error">* <?php echo $nameErr;?></span>-->
<label class="error" id="nameerror">Username is required!</label>
<label class="error" id="namenumber">Username can only contain letters and numbers!</label>
</div>
<br />

<div class="textbox">
<label for="email">Email Address: </label>
<input type="text" id="email" name="email" placeholder = "email@email.com" value="<?php echo $email;?>" />
</div>

<div class="login_error">
<!--<span class="error">* <?php echo $emailErr;?></span>-->
<label class="error" id="emailerror">Email is required!</label>				
</div>


<div class="textbox">
<label for="password">Password: </label>
<input type="password" id="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" value="<?php echo $pass;?>" />
</div>

<div class="login_error">
<!--<span class="error">* <?php echo $passErr;?></span>-->
<label class="error" id="passworderror">Password is required!</label>
<label class="error" id="passwordlength">The password must be at least 8 characters long!</label>
<label class="error" id="passwordcharacters">Password Must Contain At least 1 letter, 1 number and a special character!</label>
</div>


<div class="textbox">
<label for="repassword">Confirm Password: </label>
<input type="password" id="repassword" name="repassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" value="<?php echo $repass;?>" />
</div>


<div class="login_error">
<span class="error">* <?php echo $repassErr;?></span>
</div>

<!--

<label for="access">Access: </label>
<select name="access" id="access">
<option value = "user">User</option>
<option value = "admin">Admin</option>
</select>



<div class="login_error">
<span class="error">* <?php echo $accessErr;?></span>
</div>
-->

<button class="button2" type="submit">Register</button>
</form>

</div>
</section>

<footer id ="login">
		<p>Tenk Computers, Copyright &copy 2019</p>
	</footer>

</body>
</html>

