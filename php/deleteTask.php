<?php
session_start();
include "connection/connect.php"; 
$taskId = $_POST['taskId'];

echo $taskId;

 	$deleteTaskQuery = "delete from task where id=$taskId";
    $deleteTaskQueryResult = mysqli_query($conn, $deleteTaskQuery );
    if($deleteTaskQueryResult)
	{
		$_SESSION['update'] = 'Task deleted successfully!';
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
	else
	{
		$_SESSION['update'] = 'Error Occured';
	}

	 
?>