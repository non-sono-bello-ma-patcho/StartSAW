<?php
    require_once "databaseUtility.php";
    require_once "productUtility.php";


    /* GETTER */


function getEntireCartRow($username){
    return get_information_listed("cart","*","username",$username,false);
}

function getEntireCartColumn($column){
    return get_Entire_Column("cart", $column);
}

function getAllCart(){
    return get_All("cart");
}

/* TEST = PASS */
function getUserPurchases($username){
    return get_information_listed("purchase","item","username",$username);
}

/* TEST = PASS */
function getUserCart($username){
    return get_information_listed("cart c inner join products p on c.item = p.code","item, description, price, name","username",$username);
}

/*  TO BE TESTED */
function getPurchasesQuantity($username,$item){
    return get_information("purchases","amount",array("username","item"),array($username,$item));
}

/* TEST = PASS */
function getCartQuantity($username,$item){
    return get_information("cart","amount",array("username","item"),array($username,$item));
}

function getTotalCartPrice($username){
    $total = get_information("cart c inner join products p on c.item = p.code", "sum(price)", "username", $username);
    return $total;
}

/* TEST = PASS */
function setCartQuantity($username,$item,$newQuantity){
    return set_information("cart",array("username","item"),array($username,$item),"amount",$newQuantity);

}

function setPurchasesQuantity($username,$item,$newQuantity){
    return set_information("purchases",array("username","item",array($username,$item),"amount",$newQuantity));
}

/* TEST = PASS */
function removeFromCart($username,$item){
    row_deletion("cart",array("username","item"),array($username,$item));
}

/*  TO BE TESTED */
function insertUserPurchases($username,$hashMapOfItems){ //<key = code, value = quantity>
    $keys = array_keys($hashMapOfItems);
    foreach ($keys as $item) {
        if(in_array($item,getUserPurchases($username)))
            setPurchasesQuantity($username,$item,getPurchasesQuantity($username,$item)+1);
        else row_insertion("purchases",array($username,$item,$hashMapOfItems[$item]));
    }
}

/* TEST = PASS */
function insertUserCart($username,$item){
    if(in_array($item,getUserCart($username)))
        setCartQuantity($username,$item,getCartQuantity($username,$item)+1);
    else row_insertion("cart",array($username,$item,1));
}
