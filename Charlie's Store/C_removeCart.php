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
<?php//database connection

@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);

$code = mysqli_connect_errno();
 if($code){
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
    <title>Remove From Cart</title>
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
 <h1>Remove From Cart</h1>
    <?php
if (empty($_SESSION['cart'])) {//check if cart is empty
echo "Your cart is empty";
exit();
}
else{
	
//creates a table
echo "<h2>Items in Cart:</h2><br>";
echo "<table  class='table table-striped' border='1'>";
echo "<tr><th>ID</th><th>Product Name</th><th>Price[$]</th><th>Seller</th><th>Quantity</th><th>Remove Item</th></tr>"; //table hearders

foreach ($_SESSION['cart'] as $item) { //loops through arrays
    echo "<tr>";
    foreach ($item as $key => $value) { //value in array is assigned to $value
        echo "<td>$value</td>"; //this is echoed, they are in the order of the headers

}
//this will assign the product ID for the item being removed to a hidden post to be used later
    echo "<td>
            <form method='post'>
                <input type='hidden' name='pid' value='{$item['ID']}'> 
                <input type='submit' name='removeBtn' value='Remove'>
            </form>
          </td>";
    echo "</tr>";
}

echo "</table>";

		if(isset($_POST['removeBtn'])){//checks remove button is set
			$PID = $_POST['pid'];//assigned product ID of item in same row as remove button
		unset($_SESSION['cart'][$PID]);//removes item with matching pid

			header('location: C_removeCart.php');//refreshes Page

		}
		
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


			<br>	<!--This is for the clear cart button that brings you to the isset check below-->
		        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type='submit' name='EmptyCartBtn' value='Empty Cart'>
				</form>
<?php 
//order Placement
if(isset($_POST['EmptyCartBtn'])){//checks if button was pressed

$_SESSION['cart'] = array();//empties cart
	header('location: C_removeCart.php');//refreshes Page
		
}//end of isset
	       
?>

</main>
    </body>
</html>