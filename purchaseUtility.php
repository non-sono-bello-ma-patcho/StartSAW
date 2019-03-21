<?php
    require_once "databaseUtility.php";


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

function printUserItem($username,&$total){
    $toBePrinted = "";
    $cont = 1;
    $cart = getUserCart($username);
    foreach ($cart as $item) {
        $quantity = getCartQuantity($username,$item);
        if($cont %2 != 0)
            $toBePrinted .= "<div class = \"row\">";
        $toBePrinted .= "<div class=\"col-sm-6\">
            <div class=\"card slim-card text-white mt-2\">
                <img src=\"" . getProductImg($item) . "\" class=\"card-img\" alt=\"...\">
                <div class=\"card-img-overlay\">
                    <span class=\"badge badge-light\">".$quantity."</span>
                    <h5 class=\"card-title\">" . getProductName($item) . "</h5>".
                    //<p class=\"card-text\">" .getProductDescription($item)."</p>
                    "<p class=\"card-text\">" .getProductPrice($item)."$</p>
                </div>
            </div>
        </div>";
        if($cont %2 == 0)
            $toBePrinted.="</div>";
        $cont = $cont +1;
        $total = $total + (getProductPrice($item) * $quantity);
    }
    if($cont %2 == 0)
        $toBePrinted.="</div>";

    $toBePrinted .= "<br><br> Total price: ".$total."$";
    return $toBePrinted;
}
