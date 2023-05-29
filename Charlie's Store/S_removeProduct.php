<?php
session_start();
if(!isset($_SESSION['user']))//Checks if session exists and user logged in 
{
    if($_SESSION['user']['usertype'] == 'seller')//redirects logged in customer
    {
        
    }
	else 
		 header('location: index.php');
			exit();
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
    <title>Seller Remove Product</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	
    <body>
	
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
            <a href="S_viewOrder.php">View Orders</a>
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
 <h1>Remove Product</h1>
    <?php
	$username = $_SESSION['user']['username'];//Current logged in user
	  $sql = "SELECT * FROM products WHERE productSeller = '$username'";//this specifics only the seller can remove their own items
  $result = mysqli_query($db, $sql);
  
        if(mysqli_num_rows($result) == 0) echo "<h2>There are Currently no members registered!</h2>";
        
        else{
            echo "<h2>Listed Products:</h2><br>";
            echo "<table  class='table table-striped' border='1'>";
            echo "<tr><th>ID</th><th>Product Name</th><th>Price[$]</th><th>Seller</th><th>Remove Product from Listing</th></tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                foreach($row as $value)
                {
                    echo "<td>$value</td>";
				
                }
				//This form is for getting items varibles 
				echo "<td><form method='POST'>
                  <input type='hidden' name='product_id' value='$row[productID]'>
				  <input type='hidden' name='product_name' value='$row[productName]'>
				  <input type='hidden' name='product_price' value='$row[productPrice]'>
				  <input type='hidden' name='product_price' value='$row[productSeller]'>
                  <input type='submit' name='RemoveBtn' value='Remove'>
              </form></td>";
        echo "</tr>";
            }
            echo "</table>";
        }
		if(isset($_POST['RemoveBtn'])){//this checks if remove button is pressed 
	    {
		$PID=$_POST['product_id'];
			$sql="SELECT * FROM products WHERE productID = '$PID'";//LOOKS FOR product BEFORE DELETION
			$result=mysqli_query($db, $sql);
			if($result){
					if(mysqli_num_rows($result) === 1)
					{
							$sql="DELETE FROM products WHERE productID = '$PID'";//sql to delete  product
					$result=mysqli_query($db, $sql);
					if($result) header('location: S_removeProduct.php');//after query executed page is refreshed
            }
			
			else {}
        }
		

 
	}
		}

    ?>
</main>
    </body>
</html>