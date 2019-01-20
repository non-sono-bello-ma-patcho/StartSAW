<?php

require "userUtility.php";
$source = include("../config.php");
session_start();

function sign_in(){
	if(existingUser($_REQUEST['username'])){
		if(getUserPswd($_REQUEST['username']) !== sha1(trim($_REQUEST['pswd']))){
		    return false;
		}
		else return true;
	}
	else return false;
}



if(isset($_POST['loginform'])) {
    if(sign_in()) {
        setcookie("user", $_REQUEST['user'], time() + (3600), "/");
        $_SESSION["id"] = $_REQUEST['username'];
        /* 	OTHER COOKIES TO BE SET START*/
        /*          .
        /*			.
        /*			.
        /*			.					 */
        /*  OTHER COOKIES TO BE SET END  */
        header("Location: ".$source['private']);
        exit;
    } else {
        $_SESSION['bad_input'] = "username or password is incorrect";
        header("Location: ".$source['index']); //TODO redirect on login page.
        exit;
    }
}
else{
    $_SESSION['last_error'] = "the login form is not set";
    header("Location: error.php");
    exit;
}
?>
