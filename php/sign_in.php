<?php

require "userUtility.php";

function sign_in(){
	if(($con= database_connection()) === false)
		return false;
	else{
		$query = "SELECT pswd FROM users WHERE username = \"".$_REQUEST['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return false;
		}
		$row = mysqli_fetch_assoc($res);
		if(trim($row['pswd']) !== trim(sha1($_REQUEST['pswd']))){
			$GLOBALS['last_error'] = "password doesn't matching: ".$row['pswd'].PHP_EOL.
			" ".sha1($_REQUEST['pswd']);
			return false;
		}
		else return true;
	}
}


if(isset($_POST['loginform'])){
	if(!sign_in())
		header("Location: ../index.php");
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

?>