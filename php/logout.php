<?php
session_start(); //to ensure you are using same session
unset($_SESSION['name']);
unset($_SESSION['status']);
session_destroy(); //destroy the session
header("Location:http://localhost/infyInnovation/login.php");
exit();
?>