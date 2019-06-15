<?php

    require_once "purchaseUtility.php";
    require_once "productUtility.php";


    $cart = getUserCart($_SESSION['id']);
    $mypurchase;
    foreach ($cart as $item){
        $mypurchase[$item] = getCartQuantity($_SESSION['id'],$item);
        removeFromCart($_SESSION['id'],$item);
        setProductRelevance($_SESSION['id'],getProductRelevance($item)+1); //TODO change relevance from varchar to number
    }
    insertUserPurchases($_SESSION['id'],$mypurchase);

/* acquista tutto quello che c'è nel carrello */

/*svuota carrello */


/*aumenta la relevance del prodotto */