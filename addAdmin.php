<?php
    session_start();
    require "userUtility.php";

    if(isset($_POST['addadminform'])) {
        if (existingUser($_POST['userID'])) {
            setUserPrivileges(true, $_POST['userID']);
            header("Location: ../private.php");
            exit;
        } else {
            http_response_code(500);
            $_SESSION['last_error'] = "the user selected doesn't exist, and the first check missed the error";
            header("Location: ../error.php?code=".http_response_code());
            exit;
        }
    }
    else{
        http_response_code(503);
        $_SESSION['last_error'] = "addadminform is not set";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }