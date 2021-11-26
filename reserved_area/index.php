	<?php
	// We need to use sessions, so you should always start sessions using the below code.
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: ../index.php');
		exit;
	}

	


	require "core/functions.php";
	//require "core/array.php";
	$conn = OpenConnection();
	
	// require 'phpDebug/src/Debug/Debug.php';   			// if not using composer

	// $debug = new \bdk\Debug(array(
	// 	'collect' => true,
	// 	'output' => true,
	// ));
   
	$user=$_SESSION['name'];
	?>
	<!DOCTYPE html>
	<html dir="ltr" lang="en-US">
	<head>


		</head>

	<body>
	
		<a href="admin">area admin</a><br><br>
		<a href="core/logout.php">logout</a>

	</body>
	</html>
