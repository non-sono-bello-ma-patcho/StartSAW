<?php
session_start();
require "productUtility.php";
$source = include("../config.php");

if(isset($_POST['editproductform'])){

    /* doppio controllo */
    if(!existingProduct($_POST['eID'])){
        $_SESSION['last_error'] = "the product code is incorrect";
        header("Location: error.php");
        exit;
    }




    if(!empty($_POST["ename"]))
        setProductName($_POST['eID'],$_POST['ename']);
    if(!empty($_POST["eprice"]))
        setProductPrice($_POST['eID'],$_POST['eprice']);
    if(!empty($_POST["edescription"]))
        setProductDescription($_POST['eID'],$_POST['edescription']);
    if(!empty($_FILES['eimg']['name'])) {
        $uploaddir = $_SERVER['DOCUMENT_ROOT']."/startsaw-herschel/img/productImg/";
        $filename = basename($_FILES['eimg']['name']);
        $uploadfile = $uploaddir.$filename;

         if (!move_uploaded_file($_FILES['eimg']['tmp_name'], $uploadfile)) {
            $_SESSION['last_error'] = "failed to upload the img, the file path should be ".$uploadfile;
            header("Location: error.php");
            exit;
         }
        chmod($uploadfile,0777); //TODO TO BE CHANGED
        setProductImg($_POST['eID'],$filename);
    }
    header("Location: ".$source['private']);
    exit;
}else{
    $_SESSION['last_error'] = "editproductform is not set";
    header("Location: error.php");
    exit;
}