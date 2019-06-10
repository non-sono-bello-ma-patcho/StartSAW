<?php
require_once "databaseUtility.php";

function getUserWishList($username){
    $wishlist = get_information_listed("wishlist","item","username",$username);
    $result = [];
    while(($obj = array_pop($wishlist)) !== null)
        foreach ($obj as $key=>$value){
            array_push($result, $value);
        }
    return $result;
}

function removeFromWishList($username,$item){
    row_deletion("wishlist",array("username","item"),array($username,$item));
}

function insertUserWishList($username,$item){
    if(in_array($item,getUserWishList($username)))
        return;
    else row_insertion("wishlist",array($username,$item));
}
