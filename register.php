<?php
require_once('config.php');
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username']))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            // Bind parameters to placeholder
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute prepared query
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "Username already taken! Try New one"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
            mysqli_stmt_close($stmt);
        }
    }
// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// Insert Ito database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
        $param_username = $username;
        // Generate Hash of Password by using default algorithm for hash
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        if (mysqli_stmt_execute($stmt))
        {
            // Redirect to login.php
            header("location: login.php");
        }
        else{
            echo "Oops! Something Went Wrong Cannot Redirect";
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign_Up for Babbler</title>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="style/register.css">
</head>
<body>
<nav>
		<ul>
			<li><a href="welcome.php">home</a></li>
			<li><a href="register.php" class="active">Register</a></li>
			<li><a href="#">Game</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
</nav>
    <div class="container">
    <div class="info">
    <h3>Please Register here </h3>
    </div>
   <form action="" method="POST">
   <label for="username">Username:</label>
   <input type="text" name= "username" placeholder="Username" required>
    <br><br>
   <label for="password">Password:</label>
   <input type="password" name= "password" placeholder="Password" required>
   <br><br>
   <label for="confirm_password">Confirm Password:</label>
   <input type="password" name= "confirm_password" placeholder="Confirm Password" required>
   <br><br>
   <button type="submit" >Sign-Up</button>
   </form>  
    </div>
</body>
</html>