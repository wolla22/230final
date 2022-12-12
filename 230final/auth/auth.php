<?php

include_once('../util/crud.php');
// Connect to the database
require('../util/db.php');

// add parameters
function signup(&$file, &$user, &$password){
	//open the file for users data
	$file_add = $file;
	$file_open = fopen($file_add, "a+");
	//add formatted entry of the user/email and password to file
	$record = "\n" . $user . "," . $password;
	fwrite($file_open, $record);
	fclose($file_open);
}

// add parameters
function signin(&$data){
	$conn = connectDB("../config/connection-details.txt");
	$record=readRecord($conn, "users", $data);
	if ($record['email'] == $data['email']) {
		//check if the password is correct
		if ($data['password']== $record['password']) {
			//store session information
			$_SESSION['email'] = $data['email'];
			$_SESSION['password'] = $data['password'];
			$_SESSION['id'] = $record['ID'];
			$_SESSION['type'] = $record['type'];
			if(true){
				$_SESSION['logged']=true;
				
			}else $_SESSION['logged']=false;
			//redirect the user to the members_page.php page
			header("Location: ../index.php");
		} 
	
	} else {
		print("Record not found!");
		error_reporting(0);
	}
}

function signout(){
	//reassign SESSION values to false and null so user is signed out
	$_SESSION['logged']=false;
	$_SESSION['email']=null;
	$_SESSION['password']=null;
	session_destroy();
	// redirect the user to the public page.
	header("Location: ../index.php");
}

function is_logged(){
	// check the value of $_SESSION['logged'] value to see if they are logged in
	if (isset($_SESSION['logged'])) {
		return true;
	} else {
		return false;
	}
}