<?php
session_start();
require "productUtility.php";
$source = include("../config.php");


if(isset($_POST['addproductform'])){
    if(empty($_POST['Productid']) || empty($_POST['Productname'])
        || empty($_POST['Productprice']) || empty($_POST['Productdescription'])
        || empty($_FILES['Productimg']['name'])){
        $_SESSION['last_error'] = 'make sure to fill all fields';
        header('Location: error.php');
        exit;
    }

    $uploaddir = $_SERVER['DOCUMENT_ROOT']."/img/productImg/";
    $filename = basename($_FILES['Productimg']['name']);
    $uploadfile = $uploaddir.$filename;

    if (!move_uploaded_file($_FILES['Productimg']['tmp_name'], $uploadfile)) {
        $_SESSION['last_error'] = "failed to upload the img, the file path should be ".$uploadfile;
        header("Location: error.php");
        exit;
    }
    chmod($uploadfile,0777); //TODO TO BE CHANGED

    insertNewProduct($_POST['Productid'],$_POST['Productname'],
        $_POST['Productdescription'],$_POST['Productprice'],$filename);
    header("Location: ".$source['private']);
    exit;

}else{
    $_SESSION['last_error'] = 'addproductform is not set';
    header('Location: error.php');
    exit;
}