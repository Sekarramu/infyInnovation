<?php
session_start();
include "connection/connect.php"; 
$taskId = $_POST['updateTaskId'];
$taskComments = $_POST['updateTaskComments'];
$taskPercentage = $_POST['updateTaskPercentage'];
$taskFeedback = $_POST['updateTaskFeedback'];

//echo $taskId . "  -- " . $taskComments . " --  ". $taskPercentage . " --  " . $taskFeedback;

	if(($taskFeedback == NULL || $taskFeedback == '') && (($taskComments != '' || $taskComments!= NULL) || ($taskPercentage != '' || $taskPercentage != NULL))){
		$updateTaskDetails = "insert into taskuserupdate(task_id, percentage, comments) values($taskId,'$taskPercentage','$taskComments')";
		$updateTaskDetailsResult = mysqli_query($conn, $updateTaskDetails);
		if($updateTaskDetailsResult){
			$_SESSION['update'] = 'Task Updated successfully!';
		}else{
			$_SESSION['update'] = 'Error occured! When updating task!';
		}
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
	else if(($taskFeedback != NULL || $taskFeedback != '') && (($taskComments == '' || $taskComments == NULL) && ($taskPercentage == '' || $taskPercentage == NULL))){
		$updateTaskDetails = "insert into taskownerupdate(task_id, feedback) values($taskId,'$taskFeedback')";
		$updateTaskDetailsResult = mysqli_query($conn, $updateTaskDetails);
		if($updateTaskDetailsResult){
			$_SESSION['update'] = 'Task Updated successfully1!';
		}else{
			$_SESSION['update'] = 'Error occured! When updating task1!';
		}
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
	else{
		$_SESSION['update'] = 'Invalid params received!';
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
 	

	 
?>