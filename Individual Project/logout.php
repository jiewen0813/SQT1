<?php
session_start();
if(isset($_SESSION["SID"])){
	unset($_SESSION["SID"]);
	unset($_SESSION["userName"]);	
	header("location:index.php");
}	
?>