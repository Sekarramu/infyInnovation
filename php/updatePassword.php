<?php
session_start();
$_SESSION['update'] = 'Failed';
include "connection/connect.php"; 
$qid = $_POST['employeeid'];
$name = $_POST['name'];
$username = $_POST['emailId'];
$password = $_POST['newpassword'];

//echo $question;

 	$updateEmployeeQuery = "update admin set Name = '$name' , username ='$username' , password = '$password'
				            where id = $qid;";
    $updateEmployeeQueryresult = mysqli_query($conn, $updateEmployeeQuery);
    if($updateEmployeeQueryresult)
	{
		$_SESSION['update'] = 'Updated Successfully';
		header("Location:http://localhost/infyInnovation/pages/changePassword.php");
	}
	else
	{
		$_SESSION['update'] = 'Error Occured';
		header("Location:http://localhost/infyInnovation/pages/changePassword.php");
	}


	 
?>