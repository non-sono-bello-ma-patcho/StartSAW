<?php

session_start();
require_once "userUtility.php";
$source = include("../config.php");


$old_password = getUserPswd($_SESSION['id']);
if(isset($_REQUEST['changepasswordform'])){
    if(!empty($_REQUEST['new_password'])) {
        if ($old_password !== sha1(trim($_REQUEST['new_password']))) {
            if ($old_password !== sha1(trim($_REQUEST['old_password']))) {
                header("Location: changePasswordTest.php"); //todo change url
                exit;
            } else {
                setUserPswd($_REQUEST['new_password'], $_SESSION['id']);
                header("Location: ".$source['private']);
                exit;
            }
        }
        else {
            header("Location: changePasswordTest.php"); //todo change url
            exit;
        }
    }else{
        header("Location: changePasswordTest.php"); //todo change url
        exit;
    }

}else{
    $_SESSION['last_error'] = "changepasswordform is not set";
    header("Location: error.php");
    exit;
}