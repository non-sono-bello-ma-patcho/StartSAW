<?php
    session_start();
    require "userUtility.php";
    $source = include("../config.php");

    if(isset($_POST['addadminform'])) {
        if (existingUser($_POST['userID'])) {
            setUserPrivileges(true, $_POST['userID']);
            header("Location: " . $source['private']);
            exit;
        } else {
            $_SESSION['last_error'] = "the user selected doesn't exist";
            header("Location: error.php");
            exit;
        }
    }
    else{
        $_SESSION['last_error'] = "addadminform is not set";
        header("Location: error.php");
        exit;
    }