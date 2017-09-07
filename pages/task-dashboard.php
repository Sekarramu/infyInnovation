<?php  
session_start(); 
include "../php/connection/connect.php"; 
if($_SESSION['status'] == 'OK')
{
$name = $_SESSION['name'];
$username = $_SESSION['username'];
$role_id = $_SESSION['role_id'];
$user_id = $_SESSION['user_id'];
include "../php/calculateStats.php"; 
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>OneApp - Task Dashboard</title>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/font-awesome.min.css" rel="stylesheet">
      <link href="../css/datepicker3.css" rel="stylesheet">
      <link href="../css/bootstrap-table.css" rel="stylesheet">
      <link href="../css/styles.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
      <script src="../js/lumino.glyphs.js"></script>
      <!--Custom Font-->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!--[if lt IE 9]>
      <script src="../js/html5shiv.js"></script>
      <script src="../js/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">Welcome &nbsp;</span><?php echo $name?></a>
               <ul class="user-menu">
                  <li class="dropdown pull-right">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <svg class="glyph stroked male-user">
                           <use xlink:href="#stroked-male-user"></use>
                        </svg>
                        <?php echo $name?> <span class="caret"></span>
                     </a>
                     <ul class="dropdown-menu" role="menu">
                        <li><a href="changePassword.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a></li>
                        <!--sekar	<li><a href="timer.php"><span class="glyphicon glyphicon-record" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Shift Employees</a></li>sekar-->
                        <li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
         <!-- /.container-fluid -->
      </nav>
      <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
         <hr/>
         <ul class="nav menu">
            <li>
               <a href="employeeHome.php">
                  <svg class="glyph stroked dashboard-dial">
                     <use xlink:href="#stroked-dashboard-dial"></use>
                  </svg>
                  Personal Info
               </a>
            </li>
            <li>
               <a href="status.php">
                  <svg class="glyph stroked clock">
                     <use xlink:href="#stroked-clock"></use>
                  </svg>
                  Certification Status
               </a>
            </li>
            <li class="active">
               <a href="task-dashboard.html">
                  <svg class="glyph stroked dashboard-dial">
                     <use xlink:href="#stroked-dashboard-dial"></use>
                  </svg>
                  Task- Dashboard
               </a>
            </li>
            <!--sekar		<li><a href="../tables.php"><svg class="glyph stroked clock"><use xlink:href="#stroked-clock"></use></svg> Employees in Shifts</a></li>sekar-->
         </ul>
      </div>
      <!--/.sidebar-->
      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
         <div class="row">
            <ol class="breadcrumb">
               <li><a href="#">
                  <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                  <em class="fa fa-home"></em>
                  </a>
               </li>
               <li >Pages</li>
               <li class="active">Dashboard</li>
            </ol>
         </div>
         <!--/.row-->
         <div class="row">
            <div class="col-lg-8">
               <h1 class="page-header">Task- Dashboard</h1>
            </div>
			<?php if($role_id >= 6){ 
			
			$manageUsersQuery = "select name, user_id from employeeinfo where reporting_to='$user_id'";
			$manageUsersQueryResult = mysqli_query($conn, $manageUsersQuery);
			
			?>
            <div class="col-lg-4">
               <button type="button" class="page-header btn btn-lg btn-primary pull-right" data-toggle="modal" data-target="#addTask">Add Task</button>
               <!-- Button trigger modal -->
            </div>
			<?php } ?>
         </div>
         <!--/.row-->
         <div class="row">
			<div class="col-xs-6 col-md-4">
               <div class="panel panel-default">
                  <div class="panel-body easypiechart-panel">
                     <h4>Not Started</h4>
                     <div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $task1Graph; ?>" ><span class="percent"><?php echo $task1Graph; ?>%</span></div>
                  </div>
               </div>
            </div>
            <div class="col-xs-6 col-md-4">
               <div class="panel panel-default">
                  <div class="panel-body easypiechart-panel">
                     <h4>Started</h4>
                     <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $task2Graph; ?>" ><span class="percent"><?php echo $task2Graph; ?>%</span></div>
                  </div>
               </div>
            </div>
            <div class="col-xs-6 col-md-4">
               <div class="panel panel-default">
                  <div class="panel-body easypiechart-panel">
                     <h4>Verified</h4>
                     <div class="easypiechart" id="easypiechart-green" data-percent="<?php echo $task3Graph; ?>" ><span class="percent"><?php echo $task3Graph; ?>%</span></div>
                  </div>
               </div>
            </div>
            <div class="col-md-offset-2 col-xs-6 col-md-4">
               <div class="panel panel-default">
                  <div class="panel-body easypiechart-panel">
                     <h4>Delayed</h4>
                     <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $task4Graph; ?>" ><span class="percent"><?php echo $task5Graph; ?>%</span></div>
                  </div>
               </div>
            </div>
            <div class="col-xs-6 col-md-4">
               <div class="panel panel-default">
                  <div class="panel-body easypiechart-panel">
                     <h4>On Time</h4>
                     <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $task5Graph; ?>" ><span class="percent"><?php echo $task5Graph; ?>%</span></div>
                  </div>
               </div>
            </div>
         </div>
         <!--/.row-->
         <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                    Monthly Task Assigned Graph
                  </div>
                  <div class="panel-body">
                     <div class="canvas-wrapper">
                        <canvas class="main-chart" id="task-chart" height="200" width="600"></canvas>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--/.row-->
		 
		 <?php
		 if($role_id>=6){
			 ?>
         <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default ">
                  <div class="panel-heading">
                     Recent Task Updates
                  </div>
                  <div class="panel-body timeline-container">
                     <ul class="timeline">
						<?php
			
							$recentTaskUpdatesQuery = 'SELECT t.task_name,tu.comments FROM taskuserupdate tu JOIN task t on t.id = tu.task_id where t.assigned_by = '.$user_id.' order by tu.id desc limit 10';
							$recentTaskUpdatesQueryResult = mysqli_query($conn, $recentTaskUpdatesQuery);
						
			
							$recent_task_updates_count = $recentTaskUpdatesQueryResult->num_rows;
							if($recent_task_updates_count ){								 
									while($recentTaskUpdateRow=$recentTaskUpdatesQueryResult->fetch_assoc()){
										echo '
											<li>
												<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
													<div class="timeline-panel">
													<div class="timeline-heading">
													<h4 class="timeline-title">'.$recentTaskUpdateRow["task_name"].'</h4></div>';
										echo '<div class="timeline-body"><p>'.  $recentTaskUpdateRow["comments"] .'</p></div> </div></li>';
								
									}
									}
									else{
										echo '<h4>Sorry! No updates yet!</h4>';
									}
						?>
                     </ul>
                  </div>
               </div>
            </div>
            <!--/.col-->
         </div>
         <!--/.row-->
		 <?php
		 }
		 ?>
		 
         <!-- Table start-->
         <?php
		 if($role_id>=6){
			 $fetchTasksCreatedQuery = "select t.id, t.task_name, t.task_desc,  e.name,  t.assigned_date, 
											t.target_date, t.submit_date, t.task_status from task t JOIN employeeinfo e on t.assigned_to = e.user_id where t.assigned_by='$user_id'";
			 $fetchTasksCreatedQueryResult = mysqli_query($conn, $fetchTasksCreatedQuery);
			 $created_task_count = $fetchTasksCreatedQueryResult->num_rows;
			 
		 ?>
		  <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default ">
                  <div class="panel-heading">
                     Tasks Created by you
                  </div>
                  <div class="panel-body">
                     <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th>Task Id</th>
                              <th>Name</th>
                              <th>To</th>
                              <th>Start Date</th>
                              <th>Target Date</th>
                              <th>Completed Date</th>
                              <th>% Completed</th>
                              <th>Comments</th>
                              <th>Feedback</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <th>Task Id</th>
                              <th>Name</th>
                              <th>To</th>
                              <th>Start Date</th>
                              <th>Target Date</th>
                              <th>Completed Date</th>
                              <th>% Completed</th>
                              <th>Comments</th>
                              <th>Feedback</th>
                              <th>Action</th>
                           </tr>
                        </tfoot>
                        <tbody>
						 <?php
						 			if($created_task_count > 0){								 
									while($taskRow=$fetchTasksCreatedQueryResult->fetch_assoc()){
											$fetchTaskUpdatesQuery = "SELECT tou.feedback , NULL as percentage, NULL as comments FROM taskownerupdate tou where tou.task_id=$taskRow[id] UNION 
																	  SELECT NULL, tu.percentage, tu.comments from taskuserupdate tu WHERE tu.task_id=$taskRow[id]";
											$fetchTaskUpdatesQueryResult = mysqli_query($conn, $fetchTaskUpdatesQuery);
											
											$created_task_updates_count = $fetchTaskUpdatesQueryResult->num_rows;
											
											echo '<tr>
											<td>'.$taskRow["id"].'</td>
											<td>'.$taskRow["task_name"].'</td>
											<td>'.$taskRow["name"].'</td>
											<td>'.$taskRow["assigned_date"].'</td>
											<td>'.$taskRow["target_date"].'</td>
											<td>'.$taskRow["submit_date"].'</td>';
											
											echo '<td>';
											$percentageId = 1;
											if($created_task_updates_count > 0){
											while($taskUpdateRow=$fetchTaskUpdatesQueryResult->fetch_assoc()){
												if(NULL != $taskUpdateRow["percentage"]){
												echo $percentageId.") ".$taskUpdateRow["percentage"]."</br>";
												$percentageId++;
												}
											}
											}
											echo '</td>';
											
											echo '<td>';
											$commentsId = 1;
											if($created_task_updates_count > 0){
											mysqli_data_seek($fetchTaskUpdatesQueryResult, 0);
											while($taskUpdateRow=$fetchTaskUpdatesQueryResult->fetch_assoc()){
												if(NULL !=$taskUpdateRow["comments"]){
												echo $commentsId.") ".$taskUpdateRow["comments"]."</br>";
												$commentsId++;
												}
											}
											}
											echo '</td>';
											
											echo '<td>';
											$feedbackId=1;
											if($created_task_updates_count > 0){
											mysqli_data_seek($fetchTaskUpdatesQueryResult, 0);
											while($taskUpdateRow=$fetchTaskUpdatesQueryResult->fetch_assoc()){
												if(NULL !=$taskUpdateRow["feedback"]){
												echo $feedbackId.") ".$taskUpdateRow["feedback"]."</br>";
												$feedbackId++;
												}
											}
											}
											echo '</td>';
											// data-toggle="modal" data-target="#updateTask"

											echo '<td>';
											if($taskRow['task_status'] !=5){
												echo'
												<a><span class="glyphicon glyphicon-edit" aria-hidden="true" onclick=\'populateTaskUpdateForm("'.$taskRow["id"].'","'.$taskRow["task_name"].'","true")\' data-toggle="modal" data-target="#updateTask"></span></a>
												';
											}
												if($taskRow['task_status']==3 || $taskRow['task_status']==4 ){
												echo '
												&nbsp;
												<a><span class="glyphicon glyphicon-ok-sign" aria-hidden="true" onclick=\'verifyTaskForm("'.$taskRow["id"].'","'.$taskRow["task_name"].'")\' data-toggle="modal" data-target="#verifyTaskModal"></span></a>
												';
												}
												if($taskRow['task_status']==1){
													echo'
												&nbsp;
												<a><span class="glyphicon glyphicon-trash" aria-hidden="true" onclick=\'deleteTaskForm("'.$taskRow["id"].'","'.$taskRow["task_name"].'")\' data-toggle="modal" data-target="#deleteTaskModal"></span></a>';
												}
												
											echo '</td></tr>';
											
										}
									}
									else{
									echo '<tr>
									<td colspan="10"> You haven\'t added any tasks yet!</td>
									</tr>';
									}
						?>
                             
                           
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!--/.col-->
         </div>
         <!--/.row-->
		 <?php
		 }
		 ?>
		 
		 
		 
		  <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default ">
                  <div class="panel-heading">
                     Tasks Assiged to you
                  </div>
                  <div class="panel-body">
                     <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th>Task Id</th>
                              <th>Name</th>
                              <th>To</th>
                              <th>Start Date</th>
                              <th>Target Date</th>
                              <th>Completed Date</th>
                              <th>% Completed</th>
                              <th>Comments</th>
                              <th>Feedback</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tfoot>
                          
                        </tfoot>
                        <tbody>
                            <?php
							 $taskAssignedTable=true;
							 $fetchTasksAssignedQuery = "select t.id, t.task_name, t.task_desc,  e.name,  t.assigned_date, 
											t.target_date, t.submit_date, t.task_status from task t JOIN employeeinfo e on t.assigned_to = e.user_id where t.assigned_to='$user_id'";
							$fetchTasksAssignedQueryResult = mysqli_query($conn, $fetchTasksAssignedQuery);
							
							$task_assigned_count = $fetchTasksAssignedQueryResult->num_rows;
						 
						 if($task_assigned_count > 0){								 
									while($taskAssignedRow=$fetchTasksAssignedQueryResult->fetch_assoc()){
											
											$fetchAssignedTaskUpdatesQuery = "SELECT tou.feedback , NULL as percentage, NULL as comments FROM taskownerupdate tou where tou.task_id=$taskAssignedRow[id] UNION 
																	  SELECT NULL, tu.percentage, tu.comments from taskuserupdate tu WHERE tu.task_id=$taskAssignedRow[id]";
											$fetchAssignedTaskUpdatesQueryResult = mysqli_query($conn, $fetchAssignedTaskUpdatesQuery);
											
											$task_updates_count = $fetchAssignedTaskUpdatesQueryResult->num_rows;
											
											echo '<tr>
											<td>'.$taskAssignedRow["id"].'</td>
											<td>'.$taskAssignedRow["task_name"].'</td>
											<td>'.$taskAssignedRow["name"].'</td>
											<td>'.$taskAssignedRow["assigned_date"].'</td>
											<td>'.$taskAssignedRow["target_date"].'</td>
											<td>'.$taskAssignedRow["submit_date"].'</td>';
											
											echo '<td>';
											if($task_updates_count > 0){
											$percentageId = 1;
											while($taskUpdateRow=$fetchAssignedTaskUpdatesQueryResult->fetch_assoc()){
												if(NULL != $taskUpdateRow["percentage"]){
												echo $percentageId.") ".$taskUpdateRow["percentage"]."</br>";
												$percentageId++;
												}
											}
											}
											echo '</td>';
											
											echo '<td>';
											if($task_updates_count > 0){
											$commentsId = 1;
											mysqli_data_seek($fetchAssignedTaskUpdatesQueryResult, 0);
											while($taskUpdateRow=$fetchAssignedTaskUpdatesQueryResult->fetch_assoc()){
												if(NULL !=$taskUpdateRow["comments"]){
												echo $commentsId.") ".$taskUpdateRow["comments"]."</br>";
												$commentsId++;
												}
											}
											}
											echo '</td>';
											
											echo '<td>';
											$feedbackId=1;
											if($task_updates_count > 0){
											mysqli_data_seek($fetchAssignedTaskUpdatesQueryResult, 0);
											while($taskUpdateRow=$fetchAssignedTaskUpdatesQueryResult->fetch_assoc()){
												if(NULL !=$taskUpdateRow["feedback"]){
												echo $feedbackId.") ".$taskUpdateRow["feedback"]."</br>";
												$feedbackId++;
												}
											}
											}
											echo '</td>';
											
											echo '<td>';
												if($taskAssignedRow['task_status'] !=5){
													echo '<a><span class="glyphicon glyphicon-edit" aria-hidden="true" onclick=\'populateTaskUpdateForm("'.$taskAssignedRow["id"].'","'.$taskAssignedRow["task_name"].'","false")\' data-toggle="modal" data-target="#updateTask"></span></a>
												';
												}
											echo '</td></tr>';
											
										}
									}
									else{
									echo '<tr>
									<td colspan="10"> No tasks assigned yet!</td>
									</tr>';
									}
						?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!--/.col-->
         </div>
         <!--/.row-->
         <!-- Table end-->
      </div>
      <!--/.main-->
      <script src="../js/jquery-1.11.1.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/chart.min.js"></script>
      <script src="../js/chart-data.js"></script>
      <script src="../js/easypiechart.js"></script>
      <script src="../js/easypiechart-data.js"></script>
      <script src="../js/bootstrap-datepicker.js"></script>
      <script src="../js/custom.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
      <script>
         window.onload = function () {
         var chart1 = document.getElementById("task-chart").getContext("2d");
         window.myLine = new Chart(chart1).Line(taskChartData, {
         responsive: true,
         scaleLineColor: "rgba(0,0,0,.2)",
         scaleGridLineColor: "rgba(0,0,0,.05)",
         scaleFontColor: "#c5c7cc"
         });
		 
		 var chart1 = document.getElementById("task-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(taskChartData, {
			responsive: true
		});
		 
         };
		 
		 
      </script>
      <script>
         $(document).ready(function() {
             $('#example').DataTable();
         } );
		 
		 function addNewTask()
		 {
			 document.getElementById("addNewTaskForm").submit();
		 }
		 
		 function updateTask()
		 {
			 document.getElementById("updateTaskForm").submit();
		 }
		 
		 function deleteTask()
		 {
			 document.getElementById("deleteTaskForm").submit();
		 }
		 
		 function verifyTask()
		 {
			 document.getElementById("verifyTaskForm").submit();
		 }
		 
		 
		 function populateTaskUpdateForm(id,name,flag){
			 document.getElementById("updateTaskId").value = id;
			 document.getElementById("updateTaskName").value = name;
			 if(flag == 'true'){
				document.getElementById("ownerUpdateCheck").style.display = 'block';
				document.getElementById("commentsUpdateCheck").style.display = 'none';
				document.getElementById("percentageUpdateCheck").style.display = 'none';
				
			 }else{
				document.getElementById("ownerUpdateCheck").style.display = 'none';
				document.getElementById("commentsUpdateCheck").style.display = 'block';
				document.getElementById("percentageUpdateCheck").style.display = 'block';
			 }
		 }
		 
		 function deleteTaskForm(id,name){
			 document.getElementById("deleteTaskId").textContent = name;
			 document.getElementById("taskId").value = id;
			}
		
		function verifyTaskForm(id,name){
			 document.getElementById("verifyTask").textContent = name;
			 document.getElementById("verifyTaskId").value = id;
			}
      </script>
      <!-- Modal -->
      <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Hola! Add new task!</h4>
               </div>
               <div class="modal-body">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <form role="form" id="addNewTaskForm" action="../php/addTask.php" method="POST">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Task Name</label>
                                 <input type="text" name="taskName" class="form-control" placeholder="Name of the task">
                              </div>
                              <div class="form-group">
                                 <label>Description</label>
                                 <textarea name="taskDesc" class="form-control" rows="3"></textarea>
                              </div>
                              <div class="form-group">
							  <?php
								 $rowcount = mysqli_num_rows($manageUsersQueryResult);
								 if($rowcount != FALSE){
								 ?>
                                 <label>Assigned to</label>
								 
                                 <select class="form-control" name="assignedTo">
								    <?php
									while($userRow=mysqli_fetch_row($manageUsersQueryResult)){
											echo '<option value='.$userRow["1"].'>'.$userRow["0"].'</option>';
										}	
									?>
                                 </select>
								 <?php
								}
								?>
                                <!-- <div class="checkbox">
                                    <label>
                                    <input type="checkbox" value="">Multiple Guys
                                    </label>
                                 </div> -->
                              </div>
                              <!--<div class="form-group">
                                 <label>Assigned to</label>
                                 <select multiple class="form-control">
                                 	<option>JP</option>
                                 	<option>Sekar</option>
                                 	<option>Arun</option>
                                 	<option>Harish</option>
                                 	<option>Azar</option>
                                 </select>
                                 </div>-->
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Assignment Start Date</label>
                                 <input type="text" name="startDate" class="form-control" placeholder="yyyy-mm-dd">
                              </div>
                              <div class="form-group">
                                 <label>Assignment Target Date</label>
                                 <input type="text" name="targetDate" class="form-control" placeholder="yyyy-mm-dd">
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				  <button type="submit" class="btn btn-primary" onclick="addNewTask()">Add Task</button>
                  
               </div>
            </div>
         </div>
      </div>
	  
	  
	  <div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Give Periodic Updates!</h4>
               </div>
               <div class="modal-body">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <form role="form" id="updateTaskForm" action="../php/updateTask.php" method="POST">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Task Name</label>
                                 <input type="text" name="updateTaskName" id="updateTaskName" class="form-control" placeholder="Name of the task" readonly>
                              </div>
                              <div class="form-group" id="commentsUpdateCheck">
                                 <label>Comments</label>
                                 <textarea name="updateTaskComments" id="updateTaskComments" class="form-control" rows="3"></textarea>
                              </div>
							  
							  <div class="form-group" id="ownerUpdateCheck">
                                 <label>Feedback</label>
                                 <textarea name="updateTaskFeedback" id="updateTaskFeedback" class="form-control" rows="3"></textarea>
                              </div>
							  </div>
                            
                           <div class="col-md-6">
						    <div class="form-group">
                                 <label>Task Id</label>
                                 <input type="text" name="updateTaskId" id="updateTaskId" class="form-control" placeholder="Id of the task" readonly>
                              </div>
                              <div class="form-group" id="percentageUpdateCheck">
                                 <label>Percentage Completed</label>
                                 <input type="text" name="updateTaskPercentage" id="updateTaskPercentage" class="form-control" placeholder="0 - 100%">
                              </div>
                              
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				  <button type="submit" class="btn btn-primary" onclick="updateTask()">Update Task</button>
                  
               </div>
            </div>
         </div>
      </div>
	  
	  <div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Delete Task</h4>
               </div>
               <div class="modal-body">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <form role="form" id="deleteTaskForm" action="../php/deleteTask.php" method="POST">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Are you sure you want to delete <span id="deleteTaskId"> </span> ?</label>
                                 <input type="hidden"  name="taskId" id="taskId" class="form-control">
                              </div>
                             </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				  <button type="submit" class="btn btn-primary" onclick="deleteTask()">Delete Task</button>
                  
               </div>
            </div>
         </div>
      </div>
	  
	  <div class="modal fade" id="verifyTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Verify Task</h4>
               </div>
               <div class="modal-body">
                  <div class="panel panel-default">
                     <div class="panel-body">
                        <form role="form" id="verifyTaskForm" action="../php/verifyTask.php" method="POST">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Are you sure you want to make this <span id="verifyTask"> </span> verified?</label>
                                 <input type="hidden"  name="verifyTaskId" id="verifyTaskId" class="form-control" readonly>
                              </div>
                             </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				  <button type="submit" class="btn btn-primary" onclick="verifyTask()">Verify Task</button>
                  
               </div>
            </div>
         </div>
      </div>
	  
	  
      </div>
   </body>
</html>
<?php
}else{
	header("Location:http://localhost/infyInnovation/login.php");
}
?>