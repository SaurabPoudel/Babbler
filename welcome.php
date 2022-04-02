<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/register.css">
</head>
<body>
<nav>
		<ul>
			<li><a href="#" class="active">home</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="Tic_Tac_Toe/index.html">Game</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
</nav>
<div class="logo">
<h1><?php echo "Welcome ". $_SESSION['username']?>! You can now use this website</h1>
</div>

</body> 
</div>
</html>