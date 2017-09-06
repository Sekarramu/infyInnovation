<?php
session_start();
include "connection/connect.php"; 
$taskName = $_POST['taskName'];
$taskDesc = $_POST['taskDesc'];
$assignedTo = $_POST['assignedTo'];
$startDate = $_POST['startDate'];
$endDate = $_POST['targetDate'];
$assignedBy = $_SESSION['user_id'];

//echo $taskName . "   " . $assignedTo;

 	$insertNewTaskQuery = "insert into task(task_name,task_desc,assigned_to,assigned_date,target_date,assigned_by,task_status)
							values('$taskName','$taskDesc',$assignedTo,'$startDate','$endDate',$assignedBy,'Not Started')";
    $insertNewTaskQueryResult = mysqli_query($conn, $insertNewTaskQuery);
    if($insertNewTaskQueryResult)
	{
		$_SESSION['update'] = 'Task added successfully!';
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
	else
	{
		$_SESSION['update'] = 'Error Occured';
	}

	 
?>