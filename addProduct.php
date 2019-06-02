<?php
session_start();
require "productUtility.php";
$source = include("../config.php");


if(isset($_POST['addproductform'])){
    if(empty($_POST['Productid'])
        || empty($_POST['Productname'])
        || empty($_POST['Productprice'])
        || empty($_POST['Productdescription'])
        || empty($_POST['level'])
        || empty($_POST['duration'])
        || empty($_POST['distance'])
        || empty($_POST['minAge'])
//        || empty($_POST['guide']) // questi possono essere null
//        || empty($_POST['housing'])
        || empty($_FILES['Productimg']['name'])){ //todo aggiungere maxUsers

        http_response_code(400); // questa è una bad request, mancano dei campi
        $_SESSION['last_error'] = "some fields have not been filled before the request and the first check missed the error";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }

    $uploaddir = $_SERVER['DOCUMENT_ROOT']."/img/productImg/"; //TODO CHANGE PATH FOR THE RIBAUDO'S SERVER
    $filename = basename($_FILES['Productimg']['name']);
    $uploadfile = $uploaddir.$filename;

    if (!move_uploaded_file($_FILES['Productimg']['tmp_name'], $uploadfile)) {
        http_response_code(500);
        $_SESSION['last_error'] = "failed to upload the img,check the path or the MIME type";
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }
    chmod($uploadfile,0777); //TODO TO BE CHANGED

    insertNewProduct($_POST['Productid'],$_POST['Productname'],
        $_POST['Productdescription'],$_POST['Productprice'],"img/productImg/".$filename,
        0,$_POST['level'],$_POST['level'],$_POST['minAge'],
        $_POST['distance'],$_POST['duration'], $_POST['guide']==='y',
        $_POST['housing']==='y',3); //todo change last default parameter with $_POST['maxUsers']
    header("Location: ".$source['private']);
    exit;

}else{
    http_response_code(503);
    $_SESSION['last_error'] = 'addproductform is not set';
    header("Location: ../error.php?code=".http_response_code());
    exit;
}