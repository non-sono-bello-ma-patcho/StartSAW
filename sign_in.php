<?php

require "userUtility.php";
session_start();

function sign_in(){
	if(existingUser($_REQUEST['user'])){
		if(trim(getUserPswd($_REQUEST['user'])) !== trim(sha1($_REQUEST['pswd']))){
		    return false;
		}
		else return true;
	}
	else return false;
}



if(isset($_POST['loginform'])) {
    if(sign_in()) {
        setcookie("user", $_REQUEST['user'], time() + (3600), "/");
        $_SESSION["id"] = $_REQUEST['user'];
        /* 	OTHER COOKIES TO BE SET START*/
        /*          .
        /*			.
        /*			.
        /*			.					 */
        /*  OTHER COOKIES TO BE SET END  */
        header("Location: ../private.php");
        exit;
    } else {
        header("Location: ../index.php"); //TODO redirect on login page.
        exit;
    }
}
else{
    $_SESSION['last_error'] = "the login form is not set";
    header("Location: error.php");
    exit;
}
?>
