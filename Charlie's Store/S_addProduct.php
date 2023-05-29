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
    <title>Seller Add Product</title>
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
            <a href="S_removeProduct.php">Remove Product</a>
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
 <h1>Add Product</h1>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
Product Name: <input type="text" name="product_name"><br>
Product Price: <input type="text" name="product_price"><br>
<input type="submit" name="AddProductBtn" value="Add Product"><br>

<?php

if (isset($_POST['AddProductBtn'])){
	
	$PID = "SELECT productID FROM Products";
	$count = mysqli_query($db, $PID);
	
	           while($row = mysqli_fetch_assoc($count)){
         
                foreach($row as $value)
                {
                    
                }
                
            }   
        
						 $Pname = addslashes($_POST['product_name']);//adds product name below to seller columns
						$Pprice = addslashes($_POST['product_price']);//adds product price below to seller columns
						$Pseller=$_SESSION['user']['username'];//adds username below to seller columns
	

	 $sql = "SELECT * FROM Products WHERE productName = '$Pname'";
        $result = mysqli_query($db, $sql);
        
        //if query was valid
        if($result)
        {
            //if a record already exists with the entered username, output an error message and exit out of the script
            if(mysqli_num_rows($result) > 0)
            {
                echo "<h3>Registration failed. A Product already exists</h3>";
                exit();
            }
        }
	 $sql = "INSERT INTO Products (productID, productName, productPrice,productSeller) VALUES ('', '$Pname', '$Pprice','$Pseller')";

        $result = mysqli_query($db, $sql);

        //if the query was successful redirect the employee to employeeHome.php
        if($result)
        {
            echo "<h3>Registration successful!</h3>";
        }
        //Otherwise output a message indicating that registration failed
        else
        {
            echo "<h3>Registration failed, please try again</h3>";
        }

}
	

?> 
</main>
    </body>
</html>