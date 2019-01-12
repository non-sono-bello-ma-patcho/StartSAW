<?php

require "userUtility.php";

function sign_up(){
	if(($con= database_connection()) === false){
		return false;
	}
	else{
		$query = "INSERT INTO users VALUES(\"".$_REQUEST['name']."\",\"".$_REQUEST['surname']."\",\"".
			$_REQUEST['username']."\",\"".$_REQUEST['email']."\",\"".sha1($_REQUEST['pswd'])."\","."\"/img/default.jpg\");";  /* change img path if needed */
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = " Error 501: Failed to execute the query: ".$query.PHP_EOL;
			return false;
		}
		else return true;
	}
}

session_start();
if(isset($_POST['signupform'])){
	if(!sign_up()){
		if(!defined('DEBUG'))
			$_SESSION['last_error'] = "Something went wrong, an error occured,please retry later or send us a message";
		header("Location: error.php");
	}
	else{
		setcookie("user", $_REQUEST['username'], time() + (3600), "/");
		/* 	OTHER COOKIES TO BE SET START*/
		/*          .
		/*			.
		/*			.
		/*			.					 */
		/*  OTHER COOKIES TO BE SET END  */
		header("Location: ../index.php");
	}
}
else{
 	$_SESSION['last_error'] = "the signup form is  not set";
	 header("Location: error.php");
}
	



?>