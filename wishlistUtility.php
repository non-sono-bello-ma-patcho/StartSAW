<?php
require_once "databaseUtility.php";

function getUserWishList($username){
    return get_information_listed("wishlist","item","username",$username);
}

function removeFromWishList($username,$item){
    row_deletion("wishlist",array("username","item"),array($username,$item));
}

function insertUserWishList($username,$item){
    if(in_array($item,getUserWishList($username)))
        return;
    else row_insertion("wishlist",array($username,$item));
}
