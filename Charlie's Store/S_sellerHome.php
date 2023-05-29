<?php
session_start();
if(!isset($_SESSION['user']))//Checks if session exists and user logged in 
{
    if($_SESSION['user']['usertype'] == 'seller')//redirects logged in customer
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
    echo "Unable to connect to database";
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
    <title>Seller Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
    </head>
    <body>
	
<!--This the navigation bar and it's options-->
 <nav class="navbar navbar-inverse navbar-custom">
     <ul class="nav navbar-nav">

        	 <a class="navbar-brand" href="#">
            <img src="images/Logo.png" alt="Logo" ><br></a>
        <li>
           <a href="S_addProduct.php">Add Product</a>
        </li>
        <li>
            <a href="S_removeProduct.php">Remove Product</a>
        </li>
         <li>
            <a href="S_viewOrder.php">View Orders</a>
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
     </ul>
	</nav>
    
<main>
<h1>Seller Home Page</h1>

    <?php
        //using the 'username' value of the $_SESSION['user'] associative array to create a personal greeting
        echo "<h2>Welcome " . $_SESSION['user']['username'] . " to the Seller home page!</h2>";
    ?>
	<div class="about">
<h3>About</h3>
<P>This is the Seller side of Charlie's Shop. This means you can view customer orders and add or remove products. This site was created by Charlie McMullan.<p>
 
 <p class="disclaimer">This website was created as a fun side project </p></class>
</class>
</main>
    </body>
</html>