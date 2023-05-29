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
    echo "Unable to connect to database";
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
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!--This customises the boostrap design, the nav bar colour & main spacing from left side-->
	<link rel="stylesheet" href="Style.css">
<style>

</style>
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
<h1>Shop Products</h1>
    <?php
		  $sql = 'SELECT * FROM Products';//sql request for all in table products
  $result = mysqli_query($db, $sql);//runs request against database
		
		//if no rows match this request then it doesn't exist and echos error
        if(mysqli_num_rows($result) == 0) echo "<h2>There are Currently no members registered!</h2>";
        
        else{//else it creates a table of the products
            echo "<h2>Product Listing</h2>";
            echo "<table  class='table table-striped' border='1'>";
            echo "<tr><th>ID</th><th>Product Name</th><th>Price[$]</th><th>Seller</th><th>Add to Card</th></tr>";//table headers

            while($row = mysqli_fetch_assoc($result)){//assignes each table value to $value and echos them in table
                echo "<tr>";
                foreach($row as $value)
                {
                    echo "<td>$value</td>";
				
                }
		//This form is for adding items to a varible cart. it prints each value from the table and also adds an "add" button
       echo "<td><form method='POST'>
                  <input type='hidden' name='product_id' value='$row[productID]'>
				  <input type='hidden' name='product_name' value='$row[productName]'>
				  <input type='hidden' name='product_price' value='$row[productPrice]'>
				  <input type='hidden' name='product_seller' value='$row[productSeller]'>
                  <input type='submit' name='addToCart' value='Add'>
              </form></td>";
        echo "</tr>";
            }
            echo "</table>";
			
        }
		if(isset($_POST['addToCart'])){//checks if add button was pressed
			
		//sets form varbiles to local varibles
		$PID = $_POST['product_id'];
		$PNAME = $_POST['product_name'];
		$PPRICE = $_POST['product_price'];
		$PSELLER = $_POST['product_seller'];
		$Quantity = '1';
		//checks if item is already in cart
		if(isset($_SESSION['cart'][$PID])){
			echo "Product already in cart <br>";
		}
		else {//else adds item to cart
		$_SESSION['cart'][$PID]=array(
		'ID' => "$PID",
		'NAME' => "$PNAME",
		'PRICE' => "$PPRICE",
		'SELLER' =>"$PSELLER",
		'Quantity' => "$Quantity"
		);

	
		}

}//end of add button
//$_SESSION['cart'] = array();//used to whip array during testing

//echos details of item just added to cart
echo "<br>";
foreach ($_SESSION['cart'] as $item) {
 foreach ($item as $key => $value) {
    echo $key . ': ' . $value . '<br>';
}
echo "<br>";

}
    ?>
</main>
    </body>
</html>