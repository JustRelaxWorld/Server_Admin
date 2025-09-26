<?php
session_start();

//initializing variables
$username = "";
$errors = array();

//connect to the database
$db = mysqli_connect('localhost', 'root','cafe');

//REGISTER USER
if (isset($_POST['reg_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);


	//form validation: ensure that the form is correctly filled ...
	////by adding (array_push()) corresponding error unto $errors array
	if (empty($username)) {array_push($errors, "Username is required"); }
	if (empty($password)) {array_push($errors, "Password is required"); }
	if ($password != $confirm_password) {
		array.push($erros, "The two passwords do not match");
	}

	//first check the database to make sure
	//a user does not already exist with the same username
	$user_check_query = "SELECT * FROM user WHERE username = 'username' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	if ($user) { // if user exists
		if ($user['username'] === $username) {
			array_push($erros, "Username already exists");
		}
	}

	//Finall, register user if there are no errors in the form

	if (count($errors == 0) {
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO user (username, password)
			              VALUES ('$username', '$password')";
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You have signed up successfully.";
		header('location: index.php'
	}
}

	
