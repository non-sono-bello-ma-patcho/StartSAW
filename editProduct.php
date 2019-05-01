<?php
session_start();
require "productUtility.php";
$source = include("../config.php");

if(isset($_POST['editproductform'])){

    /* doppio controllo */
    if(!existingProduct($_POST['eID'])){
        http_response_code(500);
        $_SESSION['last_error'] = "the product code is incorrect and the first check missed the error";
        header("Location: error.php?code=".http_response_code());
        exit;
    }




    if(!empty($_POST["ename"]))
        setProductName($_POST['eID'],$_POST['ename']);
    if(!empty($_POST["eprice"]))
        setProductPrice($_POST['eID'],$_POST['eprice']);
    if(!empty($_POST["edescription"]))
        setProductDescription($_POST['eID'],$_POST['edescription']);
    if(!empty($_FILES['eimg']['name'])) {
        $uploaddir = $_SERVER['DOCUMENT_ROOT']."/img/productImg/"; //todo aggiungere gli altri campi
        $filename = basename($_FILES['eimg']['name']);
        $uploadfile = $uploaddir.$filename;

         if (!move_uploaded_file($_FILES['eimg']['tmp_name'], $uploadfile)) {
             http_response_code(500);
             $_SESSION['last_error'] = "failed to upload the img,check the path or the MIME type";
             header("Location: error.php?code=".http_response_code());
             exit;
         }
        chmod($uploadfile,0777); //TODO TO BE CHANGED
        setProductImg($_POST['eID'],$filename);
    }
    header("Location: ".$source['private']);
    exit;
}else{
    http_response_code(503);
    $_SESSION['last_error'] = "editproductform is not set";
    header("Location: error.php?code=".http_response_code());
    exit;
}