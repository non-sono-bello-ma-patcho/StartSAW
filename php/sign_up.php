<?php

require "userUtility.php";

function sign_up(){
	if(($con= database_connection()) === false){
		$GLOBALS['last_error'] = " Error 500: Connection to database failed";
		return false;
	}
	else{
		$query = "INSERT INTO users VALUES(\"".$_REQUEST['name']."\",\"".$_REQUEST['surname']."\",\"".
			$_REQUEST['user']."\",\"".$_REQUEST['email']."\",\"".sha1($_REQUEST['pswd'])."\","."\"/img/default.jpg\");";  /* change img path if needed */
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = " Error 501: Failed to execute the query: ".$query.PHP_EOL;
			return false;
		}
		else return true;
	}
}


if(isset($_POST['signupform'])){
	if(!sign_up())
		header("Location: error.php");
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