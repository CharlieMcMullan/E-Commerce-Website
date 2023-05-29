<?php
session_start();
if(!isset($_SESSION['user']))//Checks if session exists and user logged in 
{header('location: index.php');}
	else {
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
     </ul>
	</nav>
<main>
    <h1>Account Deletion</h1>
  
 			<?php echo "<h2>Delete user: <strong>". $_SESSION['user']['username']."</strong></h2>" ;?>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
	Password:<input required type="password" name="password">
    <input type="submit" name="DeleteAccountBtn" value="Delete Account"><br>
</form>    

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
	<br><input type="submit" name="BackHometBtn" value="Back to Home page">
</form>  


<?php 
if(isset($_POST['BackHometBtn']))
    {		header('location: index.php');
	}

    if(isset($_POST['DeleteAccountBtn']))
    {
					$user = $_SESSION['user']['username'];
					$Pass = $_POST['password'];
			$sql="SELECT * FROM user WHERE username = '$user' AND userpass = '$Pass'";//LOOKS FOR USER BEFORE DELETION
			$result=mysqli_query($db, $sql);
			if($result){
					if(mysqli_num_rows($result) === 1)
					{
							$sql="DELETE FROM user WHERE username = '$user' AND userpass = '$Pass'";//sql to delete user
					$result=mysqli_query($db, $sql);
					header('location: logout.php');//logs user out as they're no longer on database
            }
			else{
				 echo "<h3>Account Deletion Failed, please try again</h3>";
			}
        }

 
	}
?>

    </body>
</html>
