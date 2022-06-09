<?php

require '../../phpDebug/src/Debug/Debug.php';   			// if not using composer

$debug = new \bdk\Debug(array(
    'collect' => true,
    'output' => true,
));

require "../../core/functions.php";
$conn=OpenConnection();

if(filter_input(INPUT_GET,"idToDel")){
	
	$idToDel = filter_input(INPUT_GET, "idToDel");
	$usernameToDel=GetDataById($conn, "accounts",$idToDel);

	
    if (DeleteRecord($conn,"accounts",$idToDel)){		
		header("Location: ../index.php?msg=delSucc&obj=user");
        exit;
		
    } else {
		header("Location: ../index.php?msg=delErr&obj=user");
        exit;
    }
	
	
} else if(filter_input(INPUT_POST,"subReg")){
	$operation=filter_input(INPUT_POST,"operation");
	
	$roleArr=$_POST['rolename'];
	$roleID=$roleArr[0];
	
	if($operation=="modUser"){
		
		$userIdToMod=$_POST["idToMod"];

		
			if ($stmt = $conn->prepare('UPDATE accounts SET username=?, email=?, role_id=? WHERE id=?')) {
			
			$stmt->bind_param('ssii', $_POST['username'],$_POST['email'],$roleID,$userIdToMod);
			$stmt->execute();
		
			header("Location: ../index.php?msg=userModSucc");
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				//echo 'Could not prepare statement!';
				header("Location: ../index.php?msg=stmtErr");
			}
	
	} else if($operation=="modPass") {
	
		$userIdToMod=$_POST["idToMod"];
		
		if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
			// exit('Password must be between 5 and 20 characters long!');
			header("Location: ../../index.php?msg=passErr");
	
		}
		
		if ($stmt = $conn->prepare('UPDATE accounts SET password=? WHERE id=?')) {
		
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$stmt->bind_param('si', $password,$userIdToMod);
			$stmt->execute();

			header("Location: ../index.php?msg=passModSucc");

		} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				//echo 'Could not prepare statement!';
				header("Location: ../index.php?msg=stmtErr");
			}

	} else if($operation=="add"){

				


		// Make sure the submitted registration values are not empty.
	if (empty($_POST['username']) || empty($_POST['email']) ) {
		// One or more values are empty.
		// exit('Please complete the registration form');
		print_r("empty");
		exit;
		header("Location: ../index.php?msg=emptyUser");
		exit;
	}
	

	// if(empty($_POST['productsActive[]'])){
	// 	header("Location: ../index.php?msg=emptyProd");
	// 	exit;
	// }
	//validation
	
	if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
		// exit('Username is not valid!');
		print_r("username err");
		exit;
		header("Location: ../index.php?msg=usernameErr");
		exit;
	}

		if(empty($_POST['password'])){
			print_r("empty password");
			exit;
			header("Location: ../../index.php?msg=emptyPass");
			exit;
		}

		if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
			// exit('Password must be between 5 and 20 characters long!');
			print_r("password corta");
			exit;
			header("Location: ../../index.php?msg=passErr");
			exit;
		}
	

		// We need to check if the account with that username exists.
		if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
			// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();
			// Store the result so we can check if the account exists in the database.
			if ($stmt->num_rows > 0) {
				// Username already exists
				header("Location: ../index.php?msg=usernameExist");
			} else {
				if ($stmt = $conn->prepare('INSERT INTO accounts (username, password, email,role_id) VALUES (?, ?, ?, ?)')) {
					
					// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
					$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$stmt->bind_param('sssi', $_POST['username'], $password, $_POST['email'],$roleID);
					$stmt->execute();

				    header("Location: ../index.php?msg=userSucc");
				} else {
					// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
					header("Location: ../index.php?msg=stmtErr");
					exit;
				}

			}
		} else {
			header("Location: ../index.php?msg=userErr");
		}
	}
}


?>