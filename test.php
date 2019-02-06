<?php
session_start();
require "purchaseUtility.php";

$paolo = getUserCart("paolo");
$giovanni = getUserCart("giovanni");
$_SESSION['last_error'] = "paolo possiede : ";
    foreach($paolo as $item)
        $_SESSION['last_error'] .= $item." in quantity: ".getCartQuantity("paolo",$item)." ";
    $_SESSION['last_error'] .= " \n\n giovanni invece possiede : ";
    foreach($giovanni as $item2)
        $_SESSION['last_error'] .= $item2." in quantity: ".getCartQuantity("giovanni",$item2)." ";


    insertUserCart("paolo", "010");
    insertUserCart("paolo", "010");
insertUserCart("paolo", "011");
insertUserCart("paolo", "010");



header("Location: error.php");