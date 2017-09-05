<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SYSCO";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    $message = "Connection Failed";
	}

?>