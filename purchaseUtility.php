<?php
    require "databaseUtility.php";


    /* GETTER */

/* TEST = PASS */
function getUserPurchases($username){
    return get_information_listed("purchase","item","username",$username);
}

/* TEST = PASS */
function getUserCart($username){
    return get_information_listed("cart","item","username",$username);
}

/*  TO BE TESTED */
function getPurchasesQuantity($username,$item){
    return get_information("purchases","amount",array("username","item"),array($username,$item));
}

/* TEST = PASS */
function getCartQuantity($username,$item){
    return get_information("cart","amount",array("username","item"),array($username,$item));
}

/* TEST = PASS */
function setCartQuantity($username,$item,$newQuantity){
    return set_information("cart",array("username","item"),array($username,$item),"amount",$newQuantity);

}

/*  TO BE TESTED */
function insertUserPurchases($username,$hashMapOfItems){ //<key = code, value = quantity>
    $keys = array_keys($hashMapOfItems);
    foreach ($keys as $item) {
        row_insertion("purchases",array($username,$item,$hashMapOfItems[$item]));
    }
}

/* TEST = PASS */
function insertUserCart($username,$item){
    if(in_array($item,getUserCart($username)))
        setCartQuantity($username,$item,getCartQuantity($username,$item)+1);
    else row_insertion("cart",array($username,$item,1));
}