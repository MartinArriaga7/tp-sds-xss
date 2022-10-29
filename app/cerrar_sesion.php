<?php 
require_once("common.php");

if(isset($_SESSION["userId"]) === true){
	session_destroy();
	$_SESSION = array();
}
	
header("Location: index.php");
exit;
