<?php //start session
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
<?php //connect to database

@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);

$code = mysqli_connect_errno();
 if($code){
    echo "Unable to connect to database";//error message
    exit();
 }
 
?>

<?php //cart check
if (empty($_SESSION['cart'])) {
	$_SESSION['cart'] = array(); //creates cart if cart is empty
}
array_push($_SESSION['cart'])
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
    <title>Shop Products</title>
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
           <a href="C_customerHome.php ">Home</a>
        </li>
        <li>
			<a href="C_shopProduct.php">Shop Products</a>
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
<h1>Order Placement Confirmed</h1>
    <?php
	//once order buttons pressed in view cart it will print this 
echo "you have ordered the following:<br>";
echo "<br>"; //prints the items details that were in the cart upon purchase 
foreach ($_SESSION['cart'] as $item) {
 foreach ($item as $key => $value) {
    echo $key . ': ' . $value . '<br>';
}
echo "<br>";


}
$_SESSION['cart'] = array();//empties cart if successful
    ?>
	
<?php
			//looks for user logged in on order table 
			$Time = $_SESSION['TimeStamp'];
			$username = $_SESSION['user']['username'];
			$sql = "SELECT * FROM orders WHERE username = '$username' && time = '$Time'";
			$result = mysqli_query($db, $sql);
  
        if(mysqli_num_rows($result) == 0) echo "<h2>There are Currently Orders Placed!</h2>";//checks if row exists
        
        else{
            echo "<h2>Additional Order Info:</h2><br>";
            echo "<table  class='table table-striped' border='1''>";
			echo "<tr><th>OrderID</th><th>Timestamp</th><th>Seller</th><th>Username</th><th>ProductID</th></tr>";

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