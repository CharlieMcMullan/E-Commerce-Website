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
<?php
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();

if ($code)
{
    echo "Unable to connect to database";//error message
    exit();
}

?>
<?php //cart check
if (!empty($_SESSION['cart'])) {
	
}
else $_SESSION['cart'] = array(); //creates cart if cart is empty

?>
<!DOCTYPE html>
<html>	
	<!--This is the connect to bootstrap-->
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!--This customises the boostrap design, the nav bar colour & main spacing from left side-->
	<link rel="stylesheet" href="Style.css">
<style>

</style>
<head>
    <title>View Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
    </head>
    <body>

 <!--This the navigation bar and it's options-->
 <nav class="navbar navbar-inverse navbar-custom">
     <ul class="nav navbar-nav">
	 
        	 <a class="navbar-brand" href="C_customerHome.php">
            <img src="images/Logo.png" alt="Logo"><br></a>
        <li>
           <a href="C_customerHome.php">Home</a>
        </li>
        <li>
             <a href="C_shopProduct.php">Shop Products</a>
        </li>
         <li>
            <a href="C_removeCart.php">Remove From Cart</a>
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
 <h1>View Cart</h1>
    <?php //displays cart
	if (empty($_SESSION['cart'])) {//check if cart is empty
echo "There are no items in your cart";
exit();//this exits so the code won't continue
}
else{

echo "<h2>Items in Cart:</h2><br>";
echo "<table  class='table table-striped' border='1'>";
echo "<tr><th>ID</th><th>Product Name</th><th>Price[$]</th><th>Seller</th><th>Quantity</th></tr>"; //table hearders

foreach ($_SESSION['cart'] as $item) { //loops through arrays
    echo "<tr>";
    foreach ($item as $key => $value) { //value in array is assigned to $value
        echo "<td>$value</td>"; //this is echoed, they are in the order of the headers
    }
    echo "</tr>";
}

echo "</table>";

}
 ?>
 
 <?php //gets total
$total = 0;//initalises at 0
foreach ($_SESSION['cart'] as $item){//runs through each item 
    foreach ($item as $key => $value) {
        if ($key == 'PRICE') {//takes value for price on each item
            $total += $value;// adds them
		}
	}
	
}

echo "Total: $".$total;//prints output
    ?>
 
			<!--This is for the Order cart button that brings you to the isset check below-->
	            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type='submit' name='PlaceOrderBtn' value='Place Order'>
				</form>
<?php 
//order Placement
if(isset($_POST['PlaceOrderBtn'])){//checks if button was pressed
	
	foreach ($_SESSION['cart'] as $item) {//runs through each item in array
		$PID = $item['ID'];//sets each item called ID to $item
		$user = $_SESSION['user']['username'];//adds username to a varible
		$time = time();//adds timestamp to a varible
		$Seller = $item['SELLER'];//takes seller and puts it into order table. this is how I can restrict viewers content to whats theirs
	    $_SESSION['TimeStamp'] = $time;
		$sql = "INSERT INTO orders (ID,time, productSeller,username, productID) VALUES ('','$time', '$Seller','$user', '$PID')";//putTimestamp, Username & ID into table 'Orders'
			$result = mysqli_query($db, $sql);//runs the query
			
			}//end of for each
			if ($result) {
		echo "Order placed successfully!";//checks if it worked
		header('location: C_orderConfirmation.php'); //redirects user to order confirmation page
		}
		else {
		echo "Error placing order.";//if it didn't work
		exit();
		}


	

	
}//end of isset
	       
?>


</main>
    </body>
</html>