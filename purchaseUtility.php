<?php
    require "databaseUtility.php";


    /* GETTER */

// ritorna un array di prodotti comprati da un utente.
function getUserPurchases($username){
    return get_information_listed("purchase","code","user",$username);
}