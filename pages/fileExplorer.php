<!DOCTYPE html>
<html>
<head>
<?php  
session_start(); 
include "../php/connection/connect.php"; 
if($_SESSION['status'] == 'OK')
{
$name = $_SESSION['name'];
$username = $_SESSION['username'];

?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>OneApp - Share Point</title>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/datepicker3.css" rel="stylesheet">
<link href="../css/styles.css" rel="stylesheet">
<script src="../js/lumino.glyphs.js"></script>
	<script>
	function addQuestionShow()
	{
		var row = document.getElementById("addQuestionForm");
		var row1 = document.getElementById("updateQuestionTable");
		var row2 = document.getElementById("updateQuestionForm");
		
		row.style.display = "";  // shows the row
		row1.style.display = "none";
		row2.style.display = "none";
	}
	
		function updateQuestionShow()
	{
		var row = document.getElementById("updateQuestionTable");
		var row1 = document.getElementById("addQuestionForm");
		var row2 = document.getElementById("updateQuestionForm");
		
		row.style.display = "";  // shows the row
		row1.style.display = "none";
		row2.style.display = "none";
	}
	</script>
	


</head>

<body>
<style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body {
  background: #222222;
}
</style>
	<?php
	if(isset($_SESSION['update']))
	{
	$update = $_SESSION['update'];
	echo "<script>alert('".$update."');</script>";
	unset($_SESSION['update']);
	}
	?>
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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $name?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						  <!--  <li><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Question</a></li>-->
						  <li><a href="changePassword.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Change Password</a></li>
							<!--<li><a href="#"><span class="glyphicon glyphicon-record" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Shift Employees</a></li>-->
							<li><a href="../php/logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
			<hr/>
		
		<ul class="nav menu">
			<li>
               <a href="thoughts.php">
                  <svg class="glyph stroked dashboard-dial">
                     <use xlink:href="#stroked-dashboard-dial"></use>
                  </svg>
                  Ask a question?
               </a>
            </li>
            <li class="active">
               <a href="fileExplorer.php">
                  <svg class="glyph stroked clock">
                     <use xlink:href="#stroked-clock"></use>
                  </svg>
                  Share Point
               </a>
            </li>
            <li >
               <a href="task-dashboard.php">
                  <svg class="glyph stroked dashboard-dial">
                     <use xlink:href="#stroked-dashboard-dial"></use>
                  </svg>
                  Task- Dashboard
               </a>
            </li>
		 </ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Pages / Share Point</li>
			</ol>
		</div><!--/.row-->
		</div>
		
		
					
						<?php


if(isset($_POST['submit'])!=""){
  $name=$_FILES['photo']['name'];
  $size=$_FILES['photo']['size'];
  $type=$_FILES['photo']['type'];
  $temp=$_FILES['photo']['tmp_name'];
 # $caption1=$_POST['caption'];
#  $link=$_POST['link'];
  move_uploaded_file($temp,"files/".$name);
$insertquery= "insert into upload(name) values('$name')";
$insertqueryresult = mysqli_query($conn, $insertquery);
if($insertqueryresult){
header("location:fileExplorer.php");
}
else{
die(mysqli_error());
}
}
?>

<style>
body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
a{color:#666;}
#table{margin:0 auto;background:#333;box-shadow: 5px 5px 5px #888888;border-radius:10px;color:#CCC;padding:10px;}
#table1{margin:0 auto;}
</style>


<h3><p align="center">Upload your files here</p></h3>	
<form enctype="multipart/form-data" action="" name="form" method="post">
<table border="0" cellspacing="0" cellpadding="5" id="table">
<tr>
<th >Choose Files</th>
<td ><label for="photo"></label>
<input type="file" name="photo" id="photo" /></td>
</tr>

<tr>
<th colspan="2" scope="row"><input type="submit" name="submit" id="submit" value="Submit" /></th>
</tr>
</table>
</form>
<br />
<br />
<table border="1" align="center" id="table1" cellpadding="0" cellspacing="0">
<tr><td align="center">Click to Download</td></tr>
<?php
$selectquery= "select * from upload order by id desc";
$selectqueryresult = mysqli_query($conn, $selectquery);
while ($selectqueryRow = $selectqueryresult->fetch_assoc()) {
#								$thoughtId = $fetchThoughtsRow['id'];
#while($row1=mysql_fetch_array($select)){
	$name=$selectqueryRow['name'];
?>
<tr>
<td width="300">
<img src="tick.png" width="14" height="14"><a href="download.php?filename=<?php echo $name;?>"><?php echo $name ;?></a>
</td>
</tr>
<?php }?>
</table>

					
				
			

	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>
<?php
}
else
{
	header("Location:http://localhost/infyInnovation/login.php");
}
?>
</html>
