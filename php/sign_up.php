<?php

require "userUtility.php";
session_start();

function sign_up(){
	insertNewUser($_REQUEST['name'],$_REQUEST['surname'],$_REQUEST['username'],$_REQUEST['email'],sha1($_REQUEST['pswd']),"/img/default.jpg");
	/*
	$con= database_connection(); 
	$query = "INSERT INTO users VALUES(\"".$_REQUEST['name']."\",\"".$_REQUEST['surname']."\",\"".
			$_REQUEST['username']."\",\"".$_REQUEST['email']."\",\"".sha1($_REQUEST['pswd'])."\","."\"/img/default.jpg\");";  
	$res = mysqli_query($con,$query);
	if(!$res){

		return false;
	}
	else return true;
	*/
}


//$_SESSION['last_error'] = "no error detected";
/*$_SESSION['admin'] = 'false'; /* da spostare assolutamente ..................! */
if(isset($_POST['signupform'])){
	/*
	if(!sign_up()){
		header("Location: error.php");
		exit();
	}
	*/
	sign_up();
	//else{
	setcookie("user", $_REQUEST['username'], time() + (3600), "/");
	$_SESSION["id"] = $_REQUEST['user'];
		/* 	OTHER COOKIES TO BE SET START*/
		/*          .
		/*			.
		/*			.
		/*			.					 */
		/*  OTHER COOKIES TO BE SET END  */
	header("Location: ../cart.php");
	exit();
	//}
}
else{
 	$_SESSION['last_error'] = "the signup form is  not set";
	 header("Location: error.php");
	 exit();
}
	



?>