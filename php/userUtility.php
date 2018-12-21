<?php

// 	TO BE DELETED AFTER DEBUGGING //
$GLOBALS['last_error'] = "no error detected";


function database_connection(){
	$con = mysqli_connect("localhost","ShinonSaw","zerega1996","progettosaw"); /* TO BE CHANGED ! (USE RIBAUDO'S SERVER PSW AND USER) */
	if (mysqli_connect_errno($con)){
		$GLOBALS['last_error'] =  "Failed to connect to MySQL: " . mysqli_connect_error($con);
		return false;
	}
	else return $con;
}


/* GETTER */

function getName(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT name FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['name'];
	}
}

function getSurname(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT surname FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['surname'];
	}
}

function getMail(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT email FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['email'];
	}
}

function getPswd(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT password FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);
		return $row['password'];
	}
}

function getImg(){
	if(($con= database_connection()) === false)
		return "Error 500";
	else{
		$query = "SELECT img FROM users WHERE username = \"".$_COOKIE['user']."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		$row = mysqli_fetch_assoc($res);

		return "<img  width=\"100\" height= \"100\" src=\"".$row['img']."\">"; /* change the img's width or height if you want dude */
	}

}



/* SETTER */


function  setName($newName){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET name = \"".$newName."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		else return true;
	}
}

function  setSurname($newSurname){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET surname = \"".$newSurname."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		else return true;
	}
}

function  setMail($newMail){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET email = \"".$newMail."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		else return true;
	}
}

function  setPswd($newPswd){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET password = \"".$newPswd."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		else return true;
	}
}

function  setUser($newUser){
	if(($con = database_connection()) === false)
		return "Error 500";
	else{
		$query = "UPDATE user WHERE username = \"".$_COOKIE['user']."\" SET username = \"".$newUser."\";";
		$res = mysqli_query($con,$query);
		if(!$res){
			$GLOBALS['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
			return "Error 501";
		}
		else{
			setcookie("user",$newUser,time() + (3600), "/"); /* cookie user updated */
			return true;
		}
	}
}


?>