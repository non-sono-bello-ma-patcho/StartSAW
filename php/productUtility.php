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
	$temp = get_information("products","img","code",$product_code);
	return "<img  width=\"".$width."\" height= \"".$height."\" src=\"".$temp."\">";
}

/* SETTER */

$table, $columnKey, $key, $columToBeSet, $newValue
function  setProductName($product_code,$newName){
	return set_information("products","code",$product_code, "name",$newName);
}

function  setProductDescription($product_code,$newDescription){
	return set_information("products","code",$product_code, "description",$newDescription);
}

function  setProductPrice($product_code,$newPrice){
	return set_information("products","code",$product_code, "price",$newPrice);
}


/* NEW ITEM INSERTION */

function insertNewProduct($code,$name,$description,$price,$img_path){
	row_insertion("products", array($code,$name,$description,$price,$img_path));



/*
	if(($con= database_connection()) === false){
		return false;
	}
	else{
		$query = "INSERT INTO products VALUES(\"".$code."\",\"".$name."\",\"".$description."\",\"".
			$price."\",\"".$img_path."\"";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = " Error 501: Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return false;
		}
		else return true;
	}
	*/
}


?>
