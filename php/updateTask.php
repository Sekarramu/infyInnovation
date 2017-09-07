<?php
session_start();
include "connection/connect.php"; 
$taskId = $_POST['updateTaskId'];
$taskComments = $_POST['updateTaskComments'];
$taskPercentage = $_POST['updateTaskPercentage'];
$taskFeedback = $_POST['updateTaskFeedback'];

//echo $taskId . "  -- " . $taskComments . " --  ". $taskPercentage . " --  " . $taskFeedback;

	if(($taskFeedback == NULL || $taskFeedback == '') && (($taskComments != '' || $taskComments!= NULL) || ($taskPercentage != '' || $taskPercentage != NULL))){
		
		if($taskPercentage == 100){
			$fetchTargetTime = "select target_date from task where id=$taskId";
			$fetchTargetTimeResult = mysqli_query($conn, $fetchTargetTime);
			
			
			$taskTargetDate = $fetchTargetTimeResult->fetch_assoc();
			
			$today = date("Y-m-d");
			$today_dt = new DateTime($today);
			$target_dt = new DateTime($taskTargetDate['target_date']);
			
			if ($target_dt <= $today_dt) {
				$updateTask = "update task set task_status=(select id from task_status where status_value='On Time') where id=$taskId";
				$updateTaskResult = mysqli_query($conn, $updateTask);
			}else{
				$updateTask = "update task set task_status=(select id from task_status where status_value='Delayed') where id=$taskId";
				$updateTaskResult = mysqli_query($conn, $updateTask);
			}
			
			
		}else{
			$updateTask = "update task set task_status=(select id from task_status where status_value='Started') where id=$taskId";
			$updateTaskResult = mysqli_query($conn, $updateTask);
		}
		
		$updateTaskDetails = "insert into taskuserupdate(task_id, percentage, comments) values($taskId,'$taskPercentage','$taskComments')";
		$updateTaskDetailsResult = mysqli_query($conn, $updateTaskDetails);
		if($updateTaskDetailsResult && $updateTaskResult){
			$_SESSION['update'] = 'Task Updated successfully!';
		}else{
			$_SESSION['update'] = 'Error occured! When updating task!';
		}
		
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
	}
	else if(($taskFeedback != NULL || $taskFeedback != '') && (($taskComments == '' || $taskComments == NULL) && ($taskPercentage == '' || $taskPercentage == NULL))){
		
		$updateTask = "update task set task_status=(select id from task_status where status_value='Started') where id=$taskId";
		$updateTaskResult = mysqli_query($conn, $updateTask);
		
		$updateTaskDetails = "insert into taskownerupdate(task_id, feedback) values($taskId,'$taskFeedback')";
		$updateTaskDetailsResult = mysqli_query($conn, $updateTaskDetails);
		if($updateTaskDetailsResult && $updateTaskResult){
			$_SESSION['update'] = 'Task Updated successfully1!';
		}else{
			$_SESSION['update'] = 'Error occured! When updating task1!';
		}
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
		//echo $_SESSION['update'];
	}
	else{
		$_SESSION['update'] = 'Invalid params received!';
		header("Location:http://localhost/infyInnovation/pages/task-dashboard.php");
		//echo $_SESSION['update'];
	}
 	

	 
?>