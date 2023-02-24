<html>
<head>
<title>TENK Computers</title>

<link rel ="stylesheet" href="CSS/web.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style>

body {
background-image: url("Images/Net.jpg");
background-size: 170%;
}

div#adminerr{
background-color:#ffffff;
width: 500px;
position: absolute;
top: 15%;
left: 50%;
transform: translate(-50%,5%);
}

div#addform{
color: white; 
margin-left: 20px;
display:none;
}

div#top{
line-height: 0px;
}

input{
display:block;
} 


</style>

</head>
<body>
<?php 

session_start(); 

$loggedin = $_SESSION["logged"];
$username = $_SESSION["username"];
$access = $_SESSION["premissions"];

if ($access == "admin")
 {
  ?>
  <style>
  div#adminerr{
  display:none;
  }
  
  div#addform{
  display:block;
  } 
  </style>
<?php 
 }
?>
<?php

    $nameerr = $typeerr = $priceerr = "";
    $productname = $producttype = $productversion = $productprice = $serialnumber = $productimage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
       $productname = test_input($_POST["productname"]);
       $producttype = test_input($_POST["producttype"]);
       $productprice = test_input($_POST["productprice"]);
       $productversion = test_input($_POST['productversion']);
       $serialnumber = test_input($_POST['serialnumber']);
       $productimage = test_input($_POST['image']);

      //echo $productname.','.$producttype.','.$productversion.','.$productprice.','.$serialnumber.','.$productimage;

      if(empty($_POST["productname"]))
       {
         $nameerr = "Product name is required";  
       }
      else 
       {
        $productname = test_input($_POST["productname"]);
        if (!preg_match("/^[a-zA-Z0-9 _]*$/",$productname))
         { 
          $nameerr = "Name must contain only letters, numbers and spaces";
         }
        }
        
       if (empty($_POST['producttype']))
        {
         $typeerr = "Product type is required";        
        }
       else
        {
         $producttype = test_input($_POST["producttype"]);
         if (!preg_match("/^[a-zA-Z ]*$/",$producttype))
         {
          $typeerr = "Type must contain only letters and spaces";
         }
        }
       
       if (empty($_POST['productprice']))
        {
         $priceerr = "Product price is required";        
        }
       else
        {
         $productprice = test_input($_POST["productprice"]);
         if (!preg_match("/^[.0-9]*$/",$productprice))
         {
          $priceerr = "Price must only contain numbers and '.'";
         }
        }

       if(!empty($_POST['productversion'])){$productversion = test_input($_POST['productversion']);}
       if(!empty($_POST['serialnumber'])){$serialnumber = test_input($_POST['serialnumber']);}
       if(!empty($_POST['image'])){$productimage = test_input($_POST['image']);} 
  
       //echo $productname.','.$producttype.','.$productversion.','.$productprice.','.$serialnumber.','.$productimage;      

       if ($nameerr ==""&& $typeerr ==""&& $priceerr =="")
        {        

         $db_host="localhost";
         $db_username="testuser";
	 $db_passwd="password";

         $dbc=mysqli_connect('localhost','testuser','password','TENK_Computers')
	 or die ("Could not Connect! \n");

	 $sql = "INSERT INTO product VALUES (NULL,'$productname','$producttype','$productversion','$productprice','$serialnumber','$productimage');";
	
	 $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

	 mysqli_close();

         ?>
         <script>alert("product added successfully");</script>
         <?php

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
				<li><a href="about.php">About Us</a></li>
			</ul>
		</nav>
		</div>
	</header>



<div id="adminerr">
<img src="https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061131_960_720.png" style="height: 100px;width: 100px;">
<h1>Oops! It looks like you need to be an admin to view this page!</h1>
</div>
<br><br>
<div id="addform"><div id="top">
<h2>Add Products To The Store Page</h2>
</div>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
<label for="productname">*Product Name:</label>
<input type="text" id="productname" name="productname" value="<?php echo $productname;?>"/>
<span class="error"><?php echo $nameerr;?></span>
<br />
<label for="producttype">*Product Type: </label>
<input type="text" id="producttype" name="producttype" value="<?php echo $producttype;?>"/>
<span class="error"><?php echo $typeerr;?></span>
<br />
<label for="productversion">Product Version: </label>
<input type="text" id="productversion" name="productversion" value="<?php echo $productversion;?>" />
<br />
<label for="productprice">*Price: </label>
<input type="text" id="productprice" name="productprice" value="<?php echo $productprice;?>"/>
<span class="error"><?php echo $priceerr;?></span>
<br />
<label for="serialnumber">Serial Number: </label>
<input type="text" id="serialnumber" name="serialnumber" value="<?php echo $serialnumber;?>"/>
<br />
<label for="image">Product image: </label>
<input name="image" type="url" id="image" value="<?php echo $productimage;?>">
<br />
<input type="submit" value="Submit" name="submit" />
</form>
<br><br>
<div id="top">


<h2>Update a user to an admin</h2>
</div>
<form action ="updateuser.php" method = "post">
<label for="username">Username:</label>
<input type="text" id="user" name="user"/>
<br>
<input type="submit" value="Submit" name="submit" />
</form>
</div>

<br>
<footer>		
<p>Tenk Computers Design, Copyright &copy 2019</p>
</footer>
</body>
</html>

