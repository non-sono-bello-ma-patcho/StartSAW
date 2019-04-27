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
        http_response_code(400);
        $_SESSION['last_error'] = "username already taken";
        header("Location: ".$source['index']."?code=".http_response_code());
        exit;
    }
    if(trim($_REQUEST['pswd']) != trim($_REQUEST['pswdConfirm'])){
        http_response_code(400);
        $_SESSION['last_error'] = "password doesn't match";
        header("Location: ".$source['index']."?code=".http_response_code());
        exit;
    }

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
    http_response_code(503);
 	$_SESSION['last_error'] = "the signup form is  not set";
    header("Location: error.php?code=".http_response_code());
	 exit();
}
	



