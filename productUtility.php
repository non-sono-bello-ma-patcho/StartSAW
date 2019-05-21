<?php

require_once "databaseUtility.php";
//session_start();
 

/* GETTER */

function getEntireProductRow($product_code){
	return get_information_listed("products","*","code",$product_code,false);
}

function getEntireProductColumn($column){
	return get_Entire_Column("products", $column);
}

function getAllProducts(){
	return get_All("products");
}

function getProductName($product_code){
	return get_information("products","name","code",$product_code);
}

function getProductDescription($product_code){
	return get_information("products","description","code",$product_code);
}

function getProductPrice($product_code){
	return get_information("products","price","code",$product_code);
}

function getProductImg($product_code){
    $path = get_information("products","img","code",$product_code);
	return $path === ""? $_SERVER['DOCUMENT_ROOT']."img/imgProduct/default-product.jpg" : $path;
}

function getProductRelevance($product_code){
	return get_information("products","relevance","code",$product_code);
}

function getProductLevel($product_code){
	return get_information("products","level","code",$product_code);
}

function getProductGuide($product_code){
	return get_information("products","guide","code",$product_code);
}

function getProductDistance($product_code){
	return get_information("products","distance","code",$product_code);
}

function getProductMaxUsers($product_code){
	return get_information("products","maxUsers","code",$product_code);
}

function getProductDuration($product_code){
	return get_information("products","duration","code",$product_code);
}

function getProductMinAge($product_code){
	return get_information("products","minAge","code",$product_code);
}

function getProductHousing($product_code){
	return get_information("products","housing","code",$product_code);
}

/* SETTER */


function  setProductName($product_code,$newName){
	set_information("products","code",$product_code, "name",$newName);
}

function  setProductDescription($product_code,$newDescription){
	set_information("products","code",$product_code, "description",$newDescription);
}

function  setProductPrice($product_code,$newPrice){
	set_information("products","code",$product_code, "price",$newPrice);
}

function  setProductImg($product_code,$new_path){
	set_information("products","code",$product_code, "img","img/productImg/".$new_path);
}

function setProductRelevance($product_code,$new_relevance){
	set_information("products","code",$product_code,"relevance",$new_relevance,true);
}

function setProductLevel($product_code,$new_level){
	set_information("products","code",$product_code,"level",$new_level,true);
}

function setProductGuide($product_code,$new_guide){
	set_information("products","code",$product_code,"guide",$new_guide);
}

function setProductDistance($product_code,$new_distance){
	set_information("products","code",$product_code,"distance",$new_distance,true);
}

function setProductMaxUsers($product_code,$new_maxUsers){
	set_information("products","code",$product_code,"maxUsers",$new_maxUsers,true);
}

function setProductDuration($product_code,$new_duration){
	 set_information("products","code",$product_code,"duration",$new_duration,true);
}

function setProductMinAge($product_code,$new_minAge){
	set_information("products","code",$product_code,"minAge",$new_minAge,true);
}

function setProductHousing($product_code,$new_housing){
	set_information("products","code",$product_code,"housing",$new_housing);
}


function removeProduct($product_code){
	row_deletion("products","code",$product_code);
}
/* NEW ITEM INSERTION */

function insertNewProduct($code,$name,$description,$price,$img_path,$level,$minAge,$distance,$duration,$guide,$housing,$maxUsers){
	row_insertion("products", array(trim($code),trim($name),trim($description),trim($price),trim($img_path),0,(int)trim($level),
		(int)trim($minAge),(int)trim($distance),(int)trim($duration),$guide,$housing,(int)trim($maxUsers)));
}

function existingProduct($code){
	if(is_null(get_information("products","code","code",trim($code))))
		return false;
	else return true;
}
