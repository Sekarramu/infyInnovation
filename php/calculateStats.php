<?php
include "connection/connect.php"; 		
$user_id=3;				
$task1=1;
$task2=2;
$task3=5;
$task4=3;
$task5=4;
							
	$fetchTotalTasks = "select count(id) as taskCount from task where assigned_to = $user_id";
	$fetchTotalTasksResult = mysqli_query($conn, $fetchTotalTasks);
	$taskCountRow = mysqli_fetch_assoc($fetchTotalTasksResult);
	$taskCount = $taskCountRow['taskCount'];
			
	
		
	$procCall = mysqli_prepare($conn, 'CALL getTaskCount(?, ?, @task1Count)');
	//Task 1 count
	mysqli_stmt_bind_param($procCall, 'ii', $user_id, $task1);
	mysqli_stmt_execute($procCall);

	$select = mysqli_query($conn, 'SELECT @task1Count');
	$result = mysqli_fetch_assoc($select);
	//print_r($result);
	$task1Count= $result['@task1Count'];
	
	
	//Task 2 count
	
	mysqli_stmt_bind_param($procCall, 'ii', $user_id, $task2);
	mysqli_stmt_execute($procCall);

	$select = mysqli_query($conn, 'SELECT @task2Count');
	$result = mysqli_fetch_assoc($select);
	//print_r($result);
	$task2Count= $result['@task2Count'];
	
	//Task 3 count
	mysqli_stmt_bind_param($procCall, 'ii', $user_id, $task3);
	mysqli_stmt_execute($procCall);

	$select = mysqli_query($conn, 'SELECT @task3Count');
	$result = mysqli_fetch_assoc($select);
	$task3Count= $result['@task3Count'];
	
	//Task 4 count
	mysqli_stmt_bind_param($procCall, 'ii', $user_id, $task4);
	mysqli_stmt_execute($procCall);

	$select = mysqli_query($conn, 'SELECT @task4Count');
	$result = mysqli_fetch_assoc($select);
	$task4Count= $result['@task4Count'];
	
	//Task 5 count
	mysqli_stmt_bind_param($procCall, 'ii', $user_id, $task5);
	mysqli_stmt_execute($procCall);

	$select = mysqli_query($conn, 'SELECT @task5Count');
	$result = mysqli_fetch_assoc($select);
	$task5Count= $result['@task5Count'];
	
	//echo $task1Count. " - ".$task2Count. " - ".$task3Count. " - ".$task4Count. " - ".$task5Count."</br>";
	if($taskCount > 0){
		$task1Graph = ($task1Count / $taskCount)*100;
		$task2Graph = ($task2Count / $taskCount)*100;
		$task3Graph = ($task3Count / $taskCount)*100;
		$task4Graph = ($task4Count / $taskCount)*100;
		$task5Graph = ($task5Count / $taskCount)*100;
	}else{
		$task1Graph = 0;
		$task2Graph = 0;
		$task3Graph = 0;
		$task4Graph = 0;
		$task5Graph = 0;
	}
	
	//echo $task1Graph . " - ".$task2Graph. " - ".$task3Graph. " - ".$task4Graph. " - ".$task5Graph;
	
	$procCall = mysqli_prepare($conn, 'CALL getMonthlyTaskCount(?, ?, @taskCount)');
	$months=array("January","February","March","April","May","June","July","August","September","October","November","December"); 
	$monthlyTaskArray=array();
	foreach ($months as $month) {
		mysqli_stmt_bind_param($procCall, 'ii', $user_id, $month);
		mysqli_stmt_execute($procCall);

		$select = mysqli_query($conn, 'SELECT @taskCount');
		$result = mysqli_fetch_assoc($select);
		array_push($monthlyTaskArray,$result['@taskCount']);
	}
	$monthlyTaskJSON = json_encode($monthlyTaskArray);
	
	//echo $monthlyTaskJSON;
	 echo '<script>
	 var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	 ';
	 
	 	echo '
		var taskChartData = {
			labels : ["January","February","March","April","May","June","July","August","September","October","November","December"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : '.$monthlyTaskJSON.'
				}
			]

		};';
		echo '</script>';
?>