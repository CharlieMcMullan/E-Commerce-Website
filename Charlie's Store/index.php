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
        header('location: C_customerHome.php ');
    }
}

include ('connection.php');
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
    <title>sign-up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	 <!--This the navigation bar and it's options-->
 <nav class="navbar navbar-inverse navbar-custom">
     <ul class="nav navbar-nav">

        	 <a class="navbar-brand" href="#">
            <img src="images/Logo.png" alt="Logo";><br></a>
			        <li>
        </li>
        <li>
<a href="login.php"><Strong>Sign in</strong></a>
        </li>

     </ul>
	</nav>
<main>
    <h3>Customer Registration</h3>
   

<?php
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();

if ($code)
{
    echo "Unable to connect to database";//error message
    exit();
}

?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    User Name:<input required type="text" name="username"><br>
    Password:<input required type="password" name="pass1"><br>
    Confirm Password:<input required type="password" name="pass2"><br>
    <input type="submit" name="registerBtn" value="Sign up">
	
</form><br>





<?php

    if(isset($_POST['registerBtn']))
    {
		
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
		
        if($pass1 != $pass2)
        {
            echo "<h3>Passwords do not match, please try again</h3>";
            exit();
        }

        $username = addslashes($_POST['username']);
        $password = addslashes($pass1);

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($db, $sql);
        
        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
                echo "<h3>Registration failed. A user with that username already exists</h3>";
                exit();
            }
        }

        $sql = "INSERT INTO user (username, userpass, usertype) VALUES ('$username', '$pass1', 'customer')";

        $result = mysqli_query($db, $sql);

        if($result)
        {
            echo "<h3>Registration successful!</h3>";
        }
        else
        {
            echo "<h3>Registration failed, please try again</h3>";
        }

    }

?>
</main>
    </body>
</html>
