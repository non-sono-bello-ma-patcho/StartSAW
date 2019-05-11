<?php

session_start();
require_once "userUtility.php";
$source = include("../config.php");


$old_password = getUserPswd($_SESSION['id']);
if(isset($_REQUEST['changepasswordform'])){
    if(!empty($_REQUEST['new_password'])) {
        if ($old_password !== sha1(trim($_REQUEST['new_password']))) {
            if ($old_password !== sha1(trim($_REQUEST['old_password']))) {
                http_response_code(500);
                $_SESSION['last_error'] = "the old password  is incorrect and the first check missed the error";
                header("Location: ../error.php?code=".http_response_code());
                exit;
            } else {
                setUserPswd($_REQUEST['new_password'], $_SESSION['id']);
                header("Location: ".$source['private']);
                exit;
            }
        }
        else {
            http_response_code(500);
            $_SESSION['last_error']="the new password and the old password are the same, the first check missed the error";
            header("Location: ../error.php?code=".http_response_code());
            exit;
        }
    }else{
        http_response_code(500);
        $_SESSION['last_error'] = "some fields have not been filled before the request and the first check missed the error";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }

}else{
    http_response_code(503);
    $_SESSION['last_error'] = "changepasswordform is not set";
    header("Location: ../error.php?code=".http_response_code());
    exit;
}