<?php

require_once "userUtility.php";
require_once "purchaseUtility.php";
require_once "wishlistUtility.php";
require_once "mailUtility.php";
$source = include("../config.php");
session_start();







function sign_up(){
	insertNewUser($_REQUEST['name'],$_REQUEST['surname'],$_REQUEST['username'],$_REQUEST['email'],$_REQUEST['pswd']);
}


if(isset($_POST['signupform'])){
    if(existingUser($_REQUEST['username'])){
        http_response_code(500);
        $_SESSION['last_error'] = "username already taken,the first check missed the error";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }
	
    if(existingMail($_REQUEST['email'])){
        http_response_code(409);
        $_SESSION['last_error'] = "email already taken,the first check missed the error";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }
	
    if(trim($_REQUEST['pswd']) != trim($_REQUEST['pswdConfirm'])){
        http_response_code(500);
        $_SESSION['last_error'] = "password doesn't match, the first check missed the error";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }

	sign_up();
	setcookie("user", $_REQUEST['username'], time() + (3600), "/");
	$_SESSION["id"] = $_REQUEST['username'];
    //$_SERVER['PHP_AUTH_USER'] = true;
    /* 	OTHER COOKIES TO BE SET START*/
		/*          .
		/*			.
		/*			.
		/*			.					 */
		/*  OTHER COOKIES TO BE SET END  */
    setcookie("user", $_REQUEST['username'], time() + (3600), "/");
    setcookie("cart", serialize(getUserCart($_REQUEST['username'])), time() + (3600), "/");
    setcookie("wishlist", serialize(getUserWishList($_REQUEST['username'])), time() + (3600), "/");
    setcookie("cart-total", getTotalCartPrice($_REQUEST['username']), time() + (3600), "/");

    send_mail(1,$_REQUEST['email']);
    header("Location: ../private.php");
	exit();
}
else{
    http_response_code(503);
 	$_SESSION['last_error'] = "the signup form is  not set";
    header("Location: ../error.php?code=".http_response_code());
	 exit();
}
	



