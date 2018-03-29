<?php 
session_start();

foreach ($_SESSION as $key => $value) {
	$_SESSION[$key]=NULL;
	//echo "$key : $value<br>";
}

session_destroy();


?>
 <a href="login.php" title="Login">Login</a>