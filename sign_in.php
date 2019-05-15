<?php

require "userUtility.php";
$source = include("../config.php");
session_start();

function sign_in(){
	if(existingUser($_REQUEST['username'])){
		if(getUserPswd($_REQUEST['username']) !== sha1(trim($_REQUEST['pswd'])))
		    return "wrong_password";
		else return true;
	}
	else return false;
}



if(isset($_POST['loginform'])) {
    $log = sign_in();
    if($log === true) {
        /* 	OTHER COOKIES TO BE SET START*/
        /*          .
        /*			.
        /*			.
        /*			.					 */
        /*  OTHER COOKIES TO BE SET END  */
        setcookie("user", $_REQUEST['username'], time() + (3600), "/");
        $_SESSION["id"] = $_REQUEST['username'];
        $_SERVER['PHP_AUTH_USER'] = true;
        header("Location: ".$source['private']);
        exit;
    }else if(log === false){
        http_response_code(400);
        header("Location: ".$source['wrong_credential']."?code=".http_response_code()."&missing=username");
        exit;
    }else{
        http_response_code(400);
        setcookie("attempteduser", $_REQUEST['username'], time() + (60), "/");
        header("Location: " . $source['wrong_credential']."?code=".http_response_code()."&missing=password");
        exit;
    }
}
else{
    http_response_code(503);
    $_SESSION['last_error']= "login form is not set";
    header("Location: ../../error.php?code=".http_response_code());
    exit;
}
?>


