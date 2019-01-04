<?php

require "databaseUtility.php";


/* GETTER */

function getUserName(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT name FROM users WHERE username = \"".$_COOKIE['user']."\";";
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

function getUserSurname(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT surname FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['surname'];
	}
}

function getUserMail(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT email FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['email'];
	}
}

function getUserPswd(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT password FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['password'];
	}
}

function getUserImg(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT img FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);

		return "<img  width=\"100\" height= \"100\" src=\"".$row['img']."\">"; /* change the img's width or height if you want dude */
	}

}



/* SETTER */


function  setUserName($newName){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET name = \"".$newName."\";";
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

function  setUserSurname($newSurname){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET surname = \"".$newSurname."\";";
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

function  setUserMail($newMail){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET email = \"".$newMail."\";";
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

function  setUserPswd($newPswd){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET password = \"".$newPswd."\";";
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

function  setUserUsername($newUser){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET username = \"".$newUser."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			if(defined('DEBUG'))
				header("Location: error.php");
			return "Error 501";
		}
		else{
			setcookie("user",$newUser,time() + (3600), "/"); /* cookie user updated */
			return true;
		}
	}
}


?>