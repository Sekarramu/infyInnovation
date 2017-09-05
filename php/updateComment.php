<?php
session_start();
#$_SESSION['update'] = 'Failed';
include "connection/connect.php"; 
#$qid = $_POST['id'];
/*$name = $_POST['name'];
$username = $_POST['thoughtsId'];
$password = $_POST['newpassword'];*/
$email = $_SESSION['adminID'];
$thoughtID = $_POST['thought'];
$comment = $_POST['comment'];


    $getCommentIdQuery = "select max(id) as id from comments";
	$getCommentIdQueryresult = mysqli_query($conn, $getCommentIdQuery);
	
	if($getCommentIdQueryresult)
	{
	$commentidRow = mysqli_fetch_assoc($getCommentIdQueryresult);
	$commentid = $commentidRow['id'];
	$commentid = $commentid + 1;
	$insertCommentIdQuery = "insert into comments (id,comments,thoughtId,email)
							values($commentid,'$comment','$thoughtID','$email');";
    $insertCommentIdQueryresult = mysqli_query($conn, $insertCommentIdQuery);
    if($insertCommentIdQueryresult)
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