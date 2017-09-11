<!DOCTYPE html>
<?php 
include "php/connection/connect.php"; 
session_start();
if(isset($_SESSION['status']))
{
unset($_SESSION['status']);
}
 ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OneApp - Sign Up</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Sign Up! Gear Up!</div>
				<div class="panel-body">
					<form role="form" method="POST" action="php/registerUser.php">
						<fieldset>
							<div class="form-group">
							<label>Name</label>
								<input type="text" class="form-control" id="name" name="name" required="required" autofocus=""/>
							</div>
							<div class="form-group">
							<label>User Name</label>
								<input type="text" class="form-control" id="username" name="username" required="required"/>
							</div>
							<div class="form-group">
							<label>Password</label>
								<input type="password"  class="form-control"  id="password" name="password" required="required"/>
							</div>
							<div class="form-group">
							<label>Confirm Password</label>
								<input type="password"  class="form-control"  id="confirm_password" name="confirm_password" required="required"/>
							</div>
							<div class="form-group">
							<label>Role</label>
								 <?php
								 $getRoleQuery = "select * from role";
								 $getRoleQueryResult = mysqli_query($conn, $getRoleQuery );
								 $rowcount = mysqli_num_rows($getRoleQueryResult );
								 if($rowcount != FALSE){
								 ?>
                                 <select class="form-control" name="role_id">
								    <?php
									while($roleRow=mysqli_fetch_row($getRoleQueryResult )){
											echo '<option value='.$roleRow["0"].'>'.$roleRow["1"].'</option>';
										}	
									?>
                                 </select>
								 <?php
								}
								?>
							</div>
							<div class="form-group">
							<label>Reporting To</label>
								 <?php
								 $getReportingToQuery = "select user_id, name from employeeinfo where role_id > 5";
								 $getReportingToQueryResult = mysqli_query($conn, $getReportingToQuery  );
								 $rowcount = mysqli_num_rows($getReportingToQueryResult);
								 if($rowcount != FALSE){
								 ?>
                                 <select class="form-control" name="reporting_to">
								    <?php
									while($reportToRow=mysqli_fetch_row($getReportingToQueryResult)){
											echo '<option value='.$reportToRow["0"].'>'.$reportToRow["1"].'</option>';
										}	
									?>
                                 </select>
								 <?php
								}
								?>
							</div>
							<div class="form-group">
							<label>Birthday (yyyy-mm-dd)</label>
								<input type="text" class="form-control" id="birthday" name="birthday" required="required"/>
							</div>
							<div class="form-group">
							<label>Account</label>
								<input type="text" class="form-control" id="account" name="account" required="required"/>
							</div>
							<div class="form-group">
							<label>Team Name</label>
								<input type="text" class="form-control" id="team" name="team" required="required"/>
							</div>
							<div class="form-group">
							<label>Project Code</label>
								<input type="text" class="form-control" id="project_code" name="project_code" required="required"/>
							</div>
							<button type="submit" class="btn btn-primary">Sign Up</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
