<?php
    session_start();
    require "userUtility.php";

    if(isset($_POST['modifyform'])){
        if(!empty($_POST["modifyName"]))
            setUserName($_POST['modifyName'],$_SESSION['id']);
        if(!empty($_POST["modifySurname"]))
            setUserSurname($_POST['modifySurname'],$_SESSION['id']);
        if(!empty($_POST["modifyDescription"]))
            setUserDescription($_POST['modifyDescription'],$_SESSION['id']);
        if(!empty($_POST["modifyLocation"]))
            setUserLocation($_POST['modifyLocation'],$_SESSION['id']);
        if(!empty($_POST["modifyUsername"]))
            setUserUsername($_POST['modifyUsername'],$_SESSION['id']);
        if(!empty($_FILES['modifyImage']['name'])) {
            $uploaddir = "../img/profileImg/";
            $filename = basename($_FILES['modifyImage']['name']);
            $uploadfile = $uploaddir.$filename;

            if (!move_uploaded_file($_FILES['modifyImage']['tmp_name'], $uploadfile)) {
                http_response_code(500);
                $_SESSION['last_error'] = "failed to upload the img,check the path or the MIME type. $uploaddir is the designated path";
                header("Location: ../error.php?code=".http_response_code());
                exit;
            }
            chmod($uploadfile,0774); //TODO TO BE CHANGED
            setUserImg($filename, $_SESSION['id']);
        }
        header("Location: ../private.php");
        exit;
    }
    else{
        http_response_code(503);
        $_SESSION['last_error'] = "edituserform is not set";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }