<?php
    session_start();
    require "userUtility.php";
    $source = include("../config.php");

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
        if(!empty($_FILES['photo']['name'])) {
            $uploaddir = $_SERVER['DOCUMENT_ROOT']."/img/profileImg/";
            $filename = basename($_FILES['photo']['name']);
            $uploadfile = $uploaddir.$filename;

            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                $_SESSION['last_error'] = "failed to upload the img, the file path should be ".$uploadfile;
                header("Location: error.php");
                exit;
            }
            //chmod($uploadfile,0777); //TODO TO BE CHANGED
            setUserImg($filename, $_SESSION['id']);
        }
        header("Location: ".$source['private']);
        exit;
    }
    else{
        $_SESSION['last_error'] = "modifyform is not set";
        header("Location: error.php");
        exit;
    }