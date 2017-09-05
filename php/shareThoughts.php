<?php
session_start();
#$_SESSION['update'] = 'Failed';
include "connection/connect.php"; 
#$qid = $_POST['id'];
/*$name = $_POST['name'];
$username = $_POST['thoughtsId'];
$password = $_POST['newpassword'];*/
$email = $_SESSION['adminID'];
$thoughts = $_POST['thoughts'];



    $getThoughtsIdQuery = "select max(id) as id from thoughts";
	$getThoughtsIdQueryresult = mysqli_query($conn, $getThoughtsIdQuery);
	
	if($getThoughtsIdQueryresult)
	{
	$thoughtIDRow = mysqli_fetch_assoc($getThoughtsIdQueryresult);
	$thoughtID = $thoughtIDRow['id'];
	$thoughtID = $thoughtID + 1;
	$insertThoughtsIdQuery = "insert into thoughts (id,question,email)
							values($thoughtID,'$thoughts','$email');";
    $insertThoughtsIdQueryresult = mysqli_query($conn, $insertThoughtsIdQuery);
    if($insertThoughtsIdQueryresult)
	{
		#$_SESSION['update'] = 'Inserted Successfully';
		header("Location:http://localhost/infyInnovation/pages/thoughts.php");
	}
	else
	{
		#$_SESSION['update'] = 'Error Occured';
		header("Location:http://localhost/infyInnovation/pages/thoughts.php");
	}

	
	}
	 
?>