<?php
session_start();
if(!isset($_SESSION['user']))//Checks if session exists and user logged in 
{
    if($_SESSION['user']['usertype'] == 'customer')//redirects logged in customer
    {
        
    }
	else 
		 header('location: index.php');
}

include ('connection.php');
?>
<?php//establishes connection to database

@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);

$code = mysqli_connect_errno();
 if($code){
    echo "Unable to connect to database";//error message
    exit();
 }
 
?>

<!DOCTYPE html>
<html>
<!--This connects bootstrap to the webpage-->
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			  	<!--This customises the boostrap design, the nav bar colour & main spacing from left side & background colour & about width-->
		  <link rel="stylesheet" href="Style.css">
<style>

</style>
<head>

    <title>Customer Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
	
 <!--This the navigation bar and it's options-->
 <nav class="navbar navbar-inverse navbar-custom">
     <ul class="nav navbar-nav">

        	 <a class="navbar-brand" href="#">
            <img src="images/Logo.png" alt="Logo"><br></a>
        <li>
           <a href="C_shopProduct.php">Shop Products</a>
        </li>
        <li>
            <a href="C_removeCart.php">Remove From Cart</a>
        </li>
         <li>
            <a href="C_ViewCart.php">View Cart</a>
        </li>
		 <li>
            <a href='C_viewOrders.php'>View Orders</a><br>
        </li>
			<li class="dropdown"> <!--This is a dropdown menu for account options-->
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php
			echo "Logged in user: " . $_SESSION['user']['username'] ; //displays username 
		?><span class="caret"></a>
		<ul class="dropdown-menu">
          <li><a href='logout.php'>Log Out</a></li>
          <li><a href="deleteAccount.php">Delete Account</a></li>
        </ul>
        </li>
     </ul>
	</nav>
    
<main>
 <h1>Customer Home Page</h1>
<?php

 echo "<h2>Welcome " . $_SESSION['user']['username'] . ", to the Customer home page!</h2>"; //displays username

?>
<div class="about">
<h3>About</h3>
 <P>
This is the Seller side of Charlie's Shop. This means you can view products, add, or remove them from your cart or place orders. This site was created by Charlie McMullan.
 </p>
 
  <p class="disclaimer">This website was created as a fun side project.</p></class>
</class>
</main>
    </body>
</html>