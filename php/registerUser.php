<?php
session_start();
include "connection/connect.php"; 
$name = $_POST['name'];
$user_name = $_POST['username'];
$password = $_POST['password'];
$c_password = $_POST['confirm_password'];
$role_id = $_POST['role_id'];
$reporting_to = $_POST['reporting_to'];
$birthday = $_POST['birthday'];
$account = $_POST['account'];
$team = $_POST['team'];
$project_code = $_POST['project_code'];
$user_id=null;

mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

$insertNewUserQuery = "insert into users(username,password,status)
							values('$user_name','$password',3)";
$insertNewUserQueryResult = mysqli_query($conn, $insertNewUserQuery);


$getIdQuery = "select id from users where username = '$user_name'";
$getIdQueryResult = mysqli_query($conn, $getIdQuery);
								 
		while($idRow=mysqli_fetch_row($getIdQueryResult)){
			$user_id=$idRow["0"];
		}	
echo "User Id: -->".$user_id; 	
$insertNewUserQuery1 = "insert into employeeinfo(user_id,name,role_id, reporting_to,birthday,account,team,project_code)
							values($user_id,'$name',$role_id,$reporting_to,'$birthday','$account','$team','$project_code')";
$insertNewUserQueryResult1 = mysqli_query($conn, $insertNewUserQuery1);
		    

if ($insertNewUserQueryResult and $insertNewUserQueryResult1) {
    mysqli_commit($conn);
	$_SESSION['update'] = 'User created successfully! Please reach out to your manager to verify your id!';
	header("Location:http://localhost/infyInnovation/login.php");
} else {        
    mysqli_rollback($conn);
	$_SESSION['update'] = 'User creation failed!';
	header("Location:http://localhost/infyInnovation/login.php");
}



 		
	 
?>