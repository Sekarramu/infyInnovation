<?php
include "../php/connection/connect.php";
#$conn=mysql_connect("localhost","root","") or die(mysql_error());
#$sdb=mysql_select_db("demo",$conn) or die(mysql_error());
if(isset($_POST['submit'])!=""){
  $name=$_FILES['photo']['name'];
  $size=$_FILES['photo']['size'];
  $type=$_FILES['photo']['type'];
  $temp=$_FILES['photo']['tmp_name'];
  $caption1=$_POST['caption'];
  $link=$_POST['link'];
  move_uploaded_file($temp,"files/".$name);
$insertquery= "insert into upload(name)values('$name')";
$insertqueryresult = mysqli_query($conn, $insertquery);
if($insertqueryresult){
header("location:index.php");
}
else{
die(mysqli_error());
}
}
?>
<html>
<head>
<title>Upload and Download</title>
</head>
<style>
body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
a{color:#666;}
#table{margin:0 auto;background:#333;box-shadow: 5px 5px 5px #888888;border-radius:10px;color:#CCC;padding:10px;}
#table1{margin:0 auto;}
</style>
<body>

<h3><p align="center">Files Upload  And  Download</p></h3>	
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
</body>
</html>