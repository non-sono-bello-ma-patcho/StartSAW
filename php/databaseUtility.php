<?php

session_start();
/*  for debug use only */
define('DEBUG', 'debug'); //comment the line before the commercial use!!

$_SESSION['last_error'] = "no error detected";

function database_connection(){
	$con = mysqli_connect("localhost","ShinonSaw","zerega1996","progettosaw"); /* TO BE CHANGED ! (USE PSW AND USER OF RIBAUDO'S DATABASE) */
	if (mysqli_connect_errno($con)){
		$_SESSION['last_error'] =  "Error 500: Failed to connect to MySQL: " . mysqli_connect_error($con);
		if(defined('DEBUG'))
			header("Location: error.php");
		return false;
	}
	else return $con;

}

?>