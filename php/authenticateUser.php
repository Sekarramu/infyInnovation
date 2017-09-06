<?php
	/*
	1. Check if user is an valid user
	2. Check if password matches
	3. Check account status
	4. If pass through all validations, set SESSION variables
	*/

session_start(); 
include "connection/connect.php"; 
$_SESSION['status'] = '';
$_SESSION['name'] = '';


$username = $_POST['Username'];
$pwd = $_POST['Password'];

$usernameExistsQuery = "select * from users where username='$username'";
$usernameExistsQueryResult = mysqli_query($conn, $usernameExistsQuery);
$rowcount = mysqli_num_rows($usernameExistsQueryResult);

if ($rowcount == FALSE) {

    $message = "You are not an valid user..!!";
	$_SESSION['status'] = $message;
	echo $_SESSION['status'];
	header("Location:http://localhost/infyInnovation/login.php");
} else {

	$userCredentails = mysqli_fetch_assoc($usernameExistsQueryResult);
	/*Valid and Active user check*/
	if($userCredentails['password'] == $pwd && $userCredentails['status'] == 0)
	{
		/*Fetch User details and set it in session*/
		$userDetailsQuery = "select name,user_id,role_id,reporting_to from employeeinfo where user_id='$userCredentails[id]'";
		$userDetailsQueryResult = mysqli_query($conn, $userDetailsQuery);
		$userDetails = mysqli_fetch_assoc($userDetailsQueryResult);
		
		
		$_SESSION['status'] = 'OK';
		$_SESSION['username'] = $userCredentails["username"];
		$_SESSION['user_id'] = $userDetails["user_id"];
		$_SESSION['name'] = $userDetails["name"];
		$_SESSION['role_id'] = $userDetails["role_id"];
		
		echo $_SESSION['status'];
		echo $_SESSION['username'];
		echo $_SESSION['name'];
		echo $_SESSION['role_id'];
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
		
	}else if($userCredentails['password'] == $pwd && $userCredentails['status'] == 1){/*Valid and In-Active user check*/
		
	}else if($userCredentails['password'] == $pwd && $userCredentails['status'] == 2){/*Valid and Locked user check*/
		
	}else{
		$message = "Password you entered is wrong..!";
        $_SESSION['status'] = $message;
		header("Location:http://localhost/infyInnovation/login.php");
		echo $_SESSION['status'];
	}

    
}


?>