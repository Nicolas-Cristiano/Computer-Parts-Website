<?php
 session_start();
   $user = "";

   if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
      $user = test_input($_POST["user"]);
     
      //echo $user;

      $db_host="localhost";
      $db_username="testuser";
      $db_passwd="password";
	    
      $dbc=mysqli_connect('localhost','testuser','password','TENK_Computers')
      or die ("Could not Connect! \n");
       
      $sql="UPDATE login set access='admin' WHERE username = '$user';";
      $result = mysqli_query($dbc, $sql) or die("Error updating record:");
      ?>
      <script>alert("Admin update successful")</script>
      <?php
      mysqli_close();
      header('refresh:1,url=addproducts.php'); 
    
     }

   function test_input($data)
    {
      $data=trim ($data); 
      $data=stripslashes($data); 
      $data=htmlspecialchars($data); 
      return $data;
    }

?>


