<?php
session_start();
require "purchaseUtility.php";
//removeFromCart("giovanni","0123");

/*
$paolo = getUserCart("paolo");
$giovanni = getUserCart("giovanni");
$_SESSION['last_error'] = "paolo possiede : ";
    foreach($paolo as $item)
        $_SESSION['last_error'] .= $item." in quantity: ".getCartQuantity("paolo",$item)." ";
    $_SESSION['last_error'] .= " \n\n giovanni invece possiede : ";
    foreach($giovanni as $item2)
        $_SESSION['last_error'] .= $item2." in quantity: ".getCartQuantity("giovanni",$item2)." ";

*/

$mytest = search_items("name","products",array("name","description"),"Planet");
$_SESSION['last_error'] = "risultati della ricerca: ";
foreach($mytest as $test)
    $_SESSION['last_error'] .= $test." ";



header("Location: error.php");