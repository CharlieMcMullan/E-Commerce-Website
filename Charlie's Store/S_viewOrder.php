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
<?php

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
    <title>Seller View Orders</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	
<!--This the navigation bar and it's options-->
 <nav class="navbar navbar-inverse navbar-custom">
     <ul class="nav navbar-nav">

 
        	 <a class="navbar-brand" href="S_sellerHome.php">
            <img src="images/Logo.png" alt="Logo" ><br></a>
        <li>
           <a href="S_sellerHome.php">Home</a>
        </li>
        <li>
            <a href="S_addProduct.php">Add Product</a>
        </li>
         <li>
            <a href="S_removeProduct.php">Remove Product</a>
        </li>
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
 <h1>View Orders</h1>
<?php

      $username = $_SESSION['user']['username'];//Current logged in user
	  $sql = "SELECT * FROM orders WHERE productSeller = '$username'";//this specifics only the seller can remove their own items
       $result = mysqli_query($db, $sql);
  
        if(mysqli_num_rows($result) == 0) echo "<h2>There are Currently Orders Placed!</h2>";
        
        else{
            echo "<h2>Placed Orders:</h2><br>";
            echo "<table  class='table table-striped' border='1''>";
            echo "<tr><th>OrderID</th><th>Timestamp</th><th>seller</th></th><th>customer</th><th>ProductID</th></tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                foreach($row as $value)
                {
                    echo "<td>$value</td>";
				
                }
                echo "</tr>";
            }
            echo "</table>";
        }

?>
</main>
    </body>
</html>