<?php

require "databaseUtility.php";

 
//TODO FARE UNA CHEAT SHEET PER ANDREA
//TODO REINDIRIZZAMENTI VARI SU ERROR.PHP A SECONDA DELLA DEFINIZIONE DI DEBUG




/* GETTER */

function getProductName($product_code){
	if(($con= database_connection()) === false)
		return "Error 500"; // last error è già settato appropriamente dentro il metodo database_connection;
	else{
		$query = "SELECT name FROM products WHERE code = \"".$product_code."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['name'];
	}
}

function getProductDescription($product_code){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT description FROM products WHERE code = \"".$product_code."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['description'];
	}
}

function getProductPrice($product_code){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT price FROM products WHERE code = \"".$product_code."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['price'];
	}
}


function getProductImg($product_code){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT img FROM products WHERE code = \"".$product_code."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);

		return "<img  width=\"100\" height= \"100\" src=\"".$row['img']."\">";
	}

}

/* SETTER */


function  setproductName($product_code,$newName){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE products WHERE code = \"".$product_code."\" SET name = \"".$newName."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		else return true;
	}
}

function  setproductDescription($product_code,$newDescription){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE products WHERE code = \"".$product_code."\" SET description = \"".$newDescription."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		else return true;
	}
}

function  setproductPrice($product_code,$newPrice){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE products WHERE code = \"".$product_code."\" SET price = \"".$newPrice."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		else return true;
	}
}


/* NEW ITEM INSERTION */

function insertNewProduct($code,$name,$description,$price,$img_path){
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
}


?>
