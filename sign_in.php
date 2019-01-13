<?php

require "userUtility.php";
session_start();

function sign_in(){
	$con= database_connection();
	$query = "SELECT pswd FROM users WHERE username = \"".$_REQUEST['user']."\";";
	$res = mysqli_query($con,$query);
	if(!$res){
		$_SESSION['last_error'] = "ERROR 501: Something went wrong,please retry later or send us a message";
		return false;
	}
	$row = mysqli_fetch_assoc($res);
	if(trim($row['pswd']) !== trim(sha1($_REQUEST['pswd']))){
		$_SESSION['last_error'] = "password doesn't matching: ".$row['pswd'].PHP_EOL.
			" ".sha1($_REQUEST['pswd']);
		return "ERROR 502";
	}
	else return true;
}

/*$_SESSION['last_error'] = "no error detected";
/*$_SESSION['admin'] = 'false'; /* da spostare assolutamente ..................! */
if(isset($_POST['loginform'])){
	$status = sign_in();
	if(!$status)
		header("Location: ../error.php");
	else if($status === "ERROR 502")
		header("Location: ../index.php?log_error=502")
	else{
		setcookie("user", $_REQUEST['user'], time() + (3600), "/");
		$_SESSION["id"] = $_REQUEST['user'];
		/* 	OTHER COOKIES TO BE SET START*/
		/*          .
		/*			.
		/*			.
		/*			.					 */
		/*  OTHER COOKIES TO BE SET END  */
		header("Location: ../private.html");
	}
}
else{
	$_SESSION['last_error'] = "the login form is not set";
	header("Location: error.php");
}

?>