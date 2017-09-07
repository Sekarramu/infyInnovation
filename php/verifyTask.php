<?php
session_start();
include "connection/connect.php"; 
$taskId = $_POST['verifyTaskId'];

//echo "--->".$taskId."<---";

 	$verifyTaskQuery = "update task set task_status=(SELECT id from task_status where status_value='Verified') where id=$taskId";
    $verifyTaskQueryResult = mysqli_query($conn, $verifyTaskQuery );
    if($verifyTaskQueryResult)
	{
		$_SESSION['update'] = 'Task verified successfully!';
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
	else
	{
		$_SESSION['update'] = 'Error Occured';
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}

	 
?>