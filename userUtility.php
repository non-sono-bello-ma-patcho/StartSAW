<?php

require "databaseUtility.php";
session_start();

/* GETTER */

function getUserName($username){
	return get_information("users","name","username",trim($username));
}

function getUserSurname($username){
	return get_information("users","surname","username",trim($username));
}

function getUserMail($username){
	return get_information("users","email","username",trim($username));
}

function getUserPswd($username){
	return get_information("users","pswd","username",trim($username));
}

function getUserImg($width, $height,$username){
	$temp = get_information("users","img","username",trim($username));
	return "<img  width=\"".$width."\" height= \"".$height."\" src=\"".$temp."\">";
}



/* SETTER */


function  setUserName($newName,$username){
	set_information("users","username", trim($username), "name",trim($newName));
}

function  setUserSurname($newSurname,$username){
	set_information("users","username", trim($username), "surname",trim($newSurname));
}

function  setUserMail($newMail,$username){
	set_information("users","username", trim($username), "email",trim($newMail));
}

function  setUserPswd($newPswd,$username){
	set_information("users","username", trim($username), "pswd",trim($newPswd));
}

function  setUserUsername($newUser,$username){
	set_information("users","username", trim($username), "username",trim($newUser));
	setcookie("user",trim($newUser),time() + (3600), "/");
	$_SESSION['id'] = trim($newUser);
}

function insertNewUser($name,$surname,$username,$email,$password,$img){
	row_insertion("users", array(trim($name),trim($surname),trim($username),trim($email),trim($password),trim($img)));
}

function existingUser($username){
    if(is_null(get_information("users","username","username",trim($username))))
		return false;
	else return true;
}

function isAdmin($username){
	return get_information("users","admin","username",trim($username));
}

?>