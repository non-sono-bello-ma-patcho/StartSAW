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
            http_response_code(400);
            $_SESSION['last_error'] = "the user selected doesn't exist";
            header("Location: error.php?code=".http_response_code());
            exit;
        }
    }
    else{
        http_response_code(503);
        $_SESSION['last_error'] = "addadminform is not set";
        header("Location: error.php?code=".http_response_code());
        exit;
    }