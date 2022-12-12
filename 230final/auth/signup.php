<!doctype html>
<html lang="en">
<head>
    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include("../injections/bootstrap.html");?>
    <title>ASE 230 - class of Fall 2022</title>
    <style>
		<?php include("../injections/css.html");?>
	</style>
</head>
<body>

	<?php
	include('auth.php');
	include_once('../util/crud.php');
	include_once('../util/db.php');
	$conn = connectDB("../config/connection-details.txt");
	session_start();

	// if the user is alreay signed in, redirect them to the members_page.php page
	if (is_logged()) {
		header("Location: ../index.php");
	}
	// use the following guidelines to create the function in auth.php
	// instead of using "die", return a message that can be printed in the HTML page
	if(count($_POST)>0) {
		// check if the fields are empty
		if(!isset($_POST['email'])) 
			die('please enter your email');
			else if(!isset($_POST['password'])) 
			die('please enter your email');
		
		// check if the email is valid
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			die('Your email is invalid');
		
		// check if password length is between 8 and 16 characters
		else if(strlen($_POST['password'])<8) 
			die('Please enter a password >=8 characters');
		
		// check if the password contains at least 2 special characters
		else if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
			if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
				die('Please enter a password with 2 special characters');
			}
		}
		else {
			// encrypt password
			//$encryptedPass = password_hash($_POST['password'], PASSWORD_BCRYPT);
			// save the user in the database 
			createRecord($conn, "users", $_POST);
			header('Location: signin.php');
				exit();
		}
	}

	// improve the form
	?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="name">Name:</label><br>
	<input type="text" id="name" name="name"><br>
	<label for="email">Email:</label><br>
	<input type="text" id="email" name="email"><br>
	<label for="password">Password:</label><br>
	<input type="password" id="password" name="password"><br>
	<input type="radio" id="admin" name="type" value="admin">
	<label for="admin">Admin</label><br>
	<input type="radio" id="user" name="type" value="user">
	<label for="user">User</label><br><br>
	<input type="submit" value="Submit">
	</form> 

</body>	