<?php
session_start();
if(isset($_SESSION['user']))//Checks if session exists and user logged in 
{
    if($_SESSION['user']['usertype'] == 'seller')//redirects logged in customer
    {
        header('location: S_sellerHome.php');
    }
    elseif($_SESSION['user']['usertype'] == 'customer')//redirects logged in seller
    {
        header('location: C_customerHome.php');
    }
}

include ('connection.php');
?>
<?php

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
		<!--This customises the boostrap design adding spacing for main from left side&& setting navbar hight + colour-->
					<link rel="stylesheet" href="Style.css">
	<style>

</style>
<head>
    <title>Sign-in</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
<nav class="navbar navbar-inverse navbar-custom">
     <ul class="nav navbar-nav">
        	 <a class="navbar-brand" href="index.php">
            <img src="images/Logo.png" alt="Logo"><br></a>
			        <li>
<a href="index.php"><strong>Sign up here</strong></a>
        </li>
     </ul>
	</nav>
<main>
    <h3>Customer Login</h3>
  

<form action="login.php" method="post">
    User Name:<input required type="text" name="username"><br>
    Password:<input required type="password" name="password"><br>
    <input type="submit" name="loginBtn" value="Log In">
</form>    


<?php

    if(isset($_POST['loginBtn']))
    {
		
		echo "Login Button: " . $_POST['loginBtn'];
		
			$user = $_POST['username'];
			$Pass = $_POST['password'];

		
$sql="SELECT * FROM user WHERE username = '$user' AND userpass = '$Pass'";
$result=mysqli_query($db, $sql);
if($result){
        if(mysqli_num_rows($result) === 1)
        {

                $logged_in_user_row = mysqli_fetch_assoc($result);

                $_SESSION['user'] =  $logged_in_user_row;

                if($_SESSION['user']['usertype'] == 'customer')
                {
                    header('location: C_customerHome.php');
                }
                elseif($_SESSION['user']['usertype'] == 'seller')
                {
                    header('location: S_sellerHome.php');
                }

            }
        }

        echo "<h3>Log in failed, please try again</h3>";
	}
?>

    </body>
</html>
