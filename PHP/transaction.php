<?php

session_start();
$connect = mysqli_connect("localhost", "testuser", "password", 'TENK_Computers');
?>

<!DOCTYPE html>
<html>
<head>
        <title>Product Page</title>
        <link rel ="stylesheet" href="CSS/web.css">
        <link rel ="stylesheet" href="CSS/info.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto|Staatliches|Ubuntu" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>


<body class="infobg">

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
				<li class="current"><a href="buy.php">Buy</a></li>
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
                                       <li><a href="addproducts.php">Admin</a></li>
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

	<center><b><h1 class="pageheading">Your Cart: </h1></b></center>

  <section id="main-col">
        <div class = "contentcontainer">
                <div class="container">
      			<form method="post" action="transaction.php">
                                <table class="table table-bordered">
                                        <tr>
                                                <th width="40%">Item Name</th>
                                                <th width="20%">Quantity</th>
                                                <th width="20%">Price</th>
                                                <th width="20%">Total</th>
                                        </tr>
                                        <?php
                                        if(!empty($_SESSION["shopping_cart"]))
                                                                                {
                                                $total = 0;
                                                foreach($_SESSION["shopping_cart"] as $keys => $values)
                                                {
                                        ?>
                                        <tr>
                                                <td><?php echo $values["item_name"]; ?></td>
                                                <td class="tab"><?php echo $values["item_quantity"]; ?></td>
                                                <td class="tab">$ <?php echo $values["item_price"]; ?></td>
                                                <td class="tab">$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                                                
					</tr>
                                        <?php
                                                        $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                                }
					?>
						
					 <tr>
						<td colspan="3" align="right" class="total">Total: $ <?php echo number_format($total, 2); ?></td>
                                                <td></td>
                                        </tr>

                                        
                                        <?php
                                        }
                                        ?>

                                </table>
                                        <input type="submit" name="transaction" class="btn1" value="Proceed To Payment" />
                        </form>
                
                </div>
	</div>
  </section>

 <footer>
                <p>Tenk Computers Design, Copyright &copy 2019</p>
        </footer>
</body>
</html>

