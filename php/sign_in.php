<?php

require "userUtility.php";

function sign_in(){
	if(($con= database_connection()) === false){
		return "Error 500";
	}
	else{
		$query = "SELECT pswd FROM users WHERE username = \"".$_REQUEST['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Error 501: Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		if(trim($row['pswd']) !== trim(sha1($_REQUEST['pswd']))){
			$_SESSION['last_error'] = "password doesn't matching: ".$row['pswd'].PHP_EOL.
			" ".sha1($_REQUEST['pswd']);
			return "Error 502";
		}
		else return true;
	}
}

session_start();
if(isset($_POST['loginform'])){
	$status = sign_in();
	if($status == "Error 500" || $status == "Error 501"){
		if(!defined('DEBUG'))
			$_SESSION['last_error'] = "Something went wrong, an error occured,please retry later or send us a message";
		header("Location: error.php");
	}
	else if($status == "Error 502")
		header("Location: ../index.php"); /* se i cookie non sono settati significa che ha sbagliato la password */
	else{
		setcookie("user", $_REQUEST['user'], time() + (3600), "/");
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
	$_SESSION['last_error'] = "the login form is not set";
	header("Location: error.php");
}

?>