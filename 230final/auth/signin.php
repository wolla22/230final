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
	include("auth.php");
	session_start();

	if (is_logged()) {
		header("Location: ../index.php");
	}
	// if the user is alreay signed in, redirect them to the members_page.php page
	// use the following guidelines to create the function in auth.php
	//instead of using "die", return a message that can be printed in the HTML page
	if(count($_POST)>0){
		// 1. check if email and password have been submitted
		if(!isset($_POST['email'])) 
			echo 'please enter your email<br>';
		else if(!isset($_POST['password'])) 
			echo 'please enter your password<br>';
		// 2. check if the email is well formatted
		else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			echo 'Your email is invalid<br>';
		// 3. check if the password is well formatted
		else if(strlen($_POST['password'])<8) 
			echo 'Please enter a password >=8 characters<br>';
		else if(!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
			if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $_POST['password'])) {
				echo 'Password is not formatted correctly<br>';
			}
		} else {
			//call signin method with values of form fields
			signin($_POST);
		}
	}


	?>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="email">Email:</label><br>
	<input type="text" id="email" name="email"><br>
	<label for="password">Password:</label><br>
	<input type="password" id="password" name="password"><br>
	<input type="submit" value="Submit">
	</form> 

</body>