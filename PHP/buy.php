<?php

session_start();
$connect = mysqli_connect("localhost", "testuser", "password", 'TENK_Computers');

if(isset($_POST["add_to_cart"]))
{
        if(isset($_SESSION["shopping_cart"]))
        {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                
                        $count = count($_SESSION["shopping_cart"]);
                        $item_array = array(
                                'item_id'                       =>      $_GET["product_ID"],
                                'item_name'                     =>      $_POST["hidden_name"],
                                'item_price'            =>      $_POST["hidden_price"],
                                'item_quantity'         =>      $_POST["quantity"]
                        );
                        $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
 {
                $item_array = array(
                        'item_id'                       =>      $_GET["product_ID"],
                        'item_name'                     =>      $_POST["hidden_name"],
                        'item_price'            =>      $_POST["hidden_price"],
                        'item_quantity'         =>      $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][0] = $item_array;
        }
}

if(isset($_GET["action"]))
{
        if($_GET["action"] == "delete")
        {
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                        if($values["item_id"] == $_SESSION['shopping_cart'][$keys]["product_ID"])
                        {
                                unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="buy.php"</script>';
				break;
                        }
                }
        }
}

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
				<li><a href="about.php">About Us</a></li>
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

<center><b><h1 class="pageheading">More Products</h1></b></center>


<section id="main-col">
        <div class = "contentcontainer">
                <div class="container">
                        <?php
                                $query = "SELECT * FROM product ORDER BY product_ID ASC";
                                $result = mysqli_query($connect, $query);
                                if(mysqli_num_rows($result) > 0)
                                {
                                        while($row = mysqli_fetch_array($result))
                                        {
                                ?>
                        <div class="col-md-4">
                                <form class="item_to_choose" method="post" action="buy.php?action=add&id=<?php echo $row["product_ID"]; ?>">
                                        <div class="items_style">
                                                <img src="<?php echo $row["product_image"]; ?>" class="img-responsive" /><br />

                                                <h4 class="text-info"><?php echo $row["product_name"]; ?></h4>

                                                <h4 class="text-danger">$ <?php echo $row["product_price"]; ?></h4>

                                                <input type="text" name="quantity" value="1" id="quantity" />

                                                <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
						<input type="hidden" name="hidden_price" value="<?php echo $row["product_price"]; ?>" />
						<br>
                                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn" value="Add to Cart" />

                                        </div>
                                </form>
                        </div>
                        <?php
                                        }
                                }
                        ?>
                        <div style="clear:both"></div>
                        <br />
                        <h3>Order Details</h3>
			<div class="table-responsive">
			<form method="post" action="transaction.php">
                                <table class="table table-bordered">
                                        <tr>
                                                <th width="40%">Item Name</th>
                                                <th width="10%">Quantity</th>
                                                <th width="20%">Price</th>
                                                <th width="15%">Total</th>
                                                <th width="5%">Action</th>
                                        </tr>
                                        <?php
                                        if(!empty($_SESSION["shopping_cart"]))
										{
                                                $total = 0;
                                                foreach($_SESSION["shopping_cart"] as $keys => $values)
                                                {
                                        ?>
                                        <tr>
                                                <td ><?php echo $values["item_name"]; ?></td>
                                                <td class="tab"><?php echo $values["item_quantity"]; ?></td>
                                                <td class="tab">$ <?php echo $values["item_price"]; ?></td>
                                                <td class="tab">$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                                                <td><a href="buy.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
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
					<input type="submit" name="transaction" class="btn1" value="Proceed To CheckOut" />
			</form>
                        </div>
					</div>
        </div>
        <br />

        </div>
  </section>

 <footer>
                <p>Tenk Computers Design, Copyright &copy 2019</p>
        </footer>
</body>
</html>
