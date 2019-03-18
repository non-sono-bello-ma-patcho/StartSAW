<?php

require "databaseUtility.php";
session_start();
 

/* GETTER */

function getProductName($product_code){
	return get_information("products","name","code",$product_code);
}

function getProductDescription($product_code){
	return get_information("products","description","code",$product_code);
}

function getProductPrice($product_code){
	return get_information("products","price","code",$product_code);
}

function getProductImg($product_code,$width,$height){
	return get_information("products","img","code",$product_code);
}

/* SETTER */


function  setProductName($product_code,$newName){
	return set_information("products","code",$product_code, "name",$newName);
}

function  setProductDescription($product_code,$newDescription){
	return set_information("products","code",$product_code, "description",$newDescription);
}

function  setProductPrice($product_code,$newPrice){
	return set_information("products","code",$product_code, "price",$newPrice);
}

function  setProductImg($product_code,$new_path){
	return set_information("products","code",$product_code, "img","img/productImg/".$new_path);
}


function removeProduct($product_code){
	row_deletion("product","code",$product_code);
}
/* NEW ITEM INSERTION */

function insertNewProduct($code,$name,$description,$price,$img_path){
	row_insertion("products", array(trim($code),trim($name),trim($description),trim($price),trim($img_path)));
}

function existingProduct($code){
	if(is_null(get_information("products","code","code",trim($code))))
		return false;
	else return true;
}
?>
