<?php
session_start(); 
include "connection/connect.php"; 
$_SESSION['status'] = '';
$_SESSION['name'] = '';


$username = $_POST['Username'];
$pwd = $_POST['Password'];

$usernameExistsQuery = "select * from admin where username='$username'";

$result = mysqli_query($conn, $usernameExistsQuery);
$rowcount = mysqli_num_rows($result);
if ($rowcount == FALSE) {

    $message = "You are not an valid user..!!";
	$_SESSION['status'] = $message;
	header("Location:http://localhost/infyInnovation/login.php");
} else {

    $credentialsCheckQuery = "select Name,username,password from admin where username='$username'";
    $result = mysqli_query($conn, $credentialsCheckQuery);
    $dbpwd = mysqli_fetch_assoc($result);

    if ($dbpwd["password"] == $pwd) {
		$_SESSION['status'] = 'OK';
		$_SESSION['adminPassword'] = $pwd;
		$_SESSION['adminID'] = $dbpwd["username"];
		$_SESSION['name'] = $dbpwd["Name"];
		header("Location:http://localhost/infyInnovation/pages/thoughts.php");
	} else {

        $message = "Password you entered is wrong..!";
        $_SESSION['status'] = $message;
		header("Location:http://localhost/infyInnovation/login.php");
    }
}


?>