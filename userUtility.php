<?php

require_once "databaseUtility.php";
/**session_start(); */

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

function getUserImg($username){
	$img = get_information("users","img","username",trim($username));
    return $img == ""? "/img/default-account.png" : $img;
}

function  getUserDescription($username){
    return get_information("users","description","username",trim($username));
}

function getUserLocation($username){
    return get_information("users","location","username",trim($username));
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

function setUserDescription($newDescription,$username){
    set_information("users","username", trim($username), "description",trim($newDescription));
}

function setUserLocation($newLocation,$username){
    set_information("users","username", trim($username), "location",trim($newLocation));
}

function setUserPrivileges($newPrivileges,$username){
    set_information("users","username", trim($username), "admin",$newPrivileges?1:0, true);
}

function setUserImg($newPath,$username){
    set_information("users","username", trim($username), "img","img/profileImg/".$newPath);
}


function insertNewUser($name,$surname,$username,$email,$password){
	row_insertion("users", array(trim($name),trim($surname),trim($username),trim($email),sha1(trim($password)),
        "img/default-account.png","Hey there! I am using Herschel","Location has not been selected yet",false));
}

function existingUser($username){
    return get_information("users","username","username",trim($username))==="";
/*		return false;
	return true;*/
}

function isAdmin($username){
	return get_information("users","admin","username",trim($username));
}


?>