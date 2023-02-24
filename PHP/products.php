<html>
<head>
<title>test</title>
</head>
<body>
<?php
    $nameerr = $typeerr = $priceerr = "";
    $productname = $producttype = $productversion = $productprice = $serialnumber = $productimage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
       $productname = $_POST["productname"];
       $producttype = $_POST["producttype"];
       $productprice = $_POST["productprice"];
       $productversion = $_POST['productversion'];
       $serialnumber = $_POST['serialnumber'];
       //$productimage = test_input($_POST['image']);

      echo $productname.','.$producttype.','.$productversion.','.$productprice.','.$serialnumber.','.$productimage;

   /*

        $db_host="localhost";
         $db_username="testuser";
	 $db_passwd="password";

         $dbc=mysqli_connect('localhost','testuser','password','TENK_Computers')
	 or die ("Could not Connect! \n");

	 $sql = "INSERT INTO product VALUES (NULL,'$productname','$producttype','$productversion','$productprice','$serialnumber','$productimage');";
	
	 $result=mysqli_query($dbc,$sql) or die ("Error Querying Database");

	 mysqli_close();

  */
}

?>
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
<input name="image" type="text" id="image" value="<?php echo $productimage;?>">
<br />
<input type="submit" value="Submit" name="submit" />
</form>
</body>
</html>
