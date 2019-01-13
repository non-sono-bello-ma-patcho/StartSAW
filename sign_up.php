<?php

require "userUtility.php";
session_start();

function sign_up(){
    //TODO check if the user already exist. key conflict
	insertNewUser($_REQUEST['name'],$_REQUEST['surname'],$_REQUEST['username'],$_REQUEST['email'],sha1($_REQUEST['pswd']),"/img/default.jpg");
}


if(isset($_POST['signupform'])){
	sign_up();
	setcookie("user", $_REQUEST['username'], time() + (3600), "/");
	$_SESSION["id"] = $_REQUEST['user'];
		/* 	OTHER COOKIES TO BE SET START*/
		/*          .
		/*			.
		/*			.
		/*			.					 */
		/*  OTHER COOKIES TO BE SET END  */
	header("Location: ../private.php");
	exit();
}
else{
 	$_SESSION['last_error'] = "the signup form is  not set";
	 header("Location: error.php");
	 exit();
}
	



?>