<?php

require "userUtility.php";
require "mailUtility.php";
$source = include("../config.php");
session_start();









function sign_up(){
	insertNewUser($_REQUEST['name'],$_REQUEST['surname'],$_REQUEST['username'],$_REQUEST['email'],$_REQUEST['pswd']);
}


if(isset($_POST['signupform'])){
    if(existingUser($_REQUEST['username'])){
        $_SESSION['bad_input'] = "username already taken";
        header("Location: ".$source['index']);
        exit;
    }
    if(trim($_REQUEST['pswd']) != trim($_REQUEST['pswdConfirm'])){
        $_SESSION['bad_input'] = "password don't match";
        header("Location: ".$source['index']);
        exit;
    }
    /*
    if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) !== true){
        $_SESSION['bad_input'] = "invalid email";
        header("Location: ".$source['index']);
        exit;  //TODO i bad input non sono utilizzati
    }
*/
	sign_up();
	setcookie("user", $_REQUEST['username'], time() + (3600), "/");
	$_SESSION["id"] = $_REQUEST['username'];
		/* 	OTHER COOKIES TO BE SET START*/
		/*          .
		/*			.
		/*			.
		/*			.					 */
		/*  OTHER COOKIES TO BE SET END  */
    send_mail(1,$_REQUEST['email']);
    header("Location: ".$source['private']);
	exit();
}
else{
 	$_SESSION['last_error'] = "the signup form is  not set";
	 header("Location: error.php");
	 exit();
}
	



