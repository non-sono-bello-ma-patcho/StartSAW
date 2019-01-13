<?php

require "databaseUtility.php";
session_start();

/* GETTER */

function getUserName(){
	return get_information("users","name","username",$_SESSION['id']);
}

function getUserSurname(){
	return get_information("users","surname","username",$_SESSION['id']);
}

function getUserMail(){
	return get_information("users","email","username",$_SESSION['id']);
}

function getUserPswd(){
	return get_information("users","password","username",$_SESSION['id']);
}

function getUserImg($width, $height){
	$temp = get_information("users","img","username",$_SESSION['id']);
	return "<img  width=\"".$width."\" height= \"".$height."\" src=\"".$temp."\">";
}



/* SETTER */


function  setUserName($newName){
	return set_information("users","username", $_SESSION['id'], "name",$newName);
}

function  setUserSurname($newSurname){
	return set_information("users","username", $_SESSION['id'], "surname",$newSurname);
}

function  setUserMail($newMail){
	return set_information("users","username", $_SESSION['id'], "email",$newMail);
}

function  setUserPswd($newPswd){
	return set_information("users","username", $_SESSION['id'], "password",$newPswd);
}

function  setUserUsername($newUser){
	set_information("users","username", $_SESSION['id'], "username",$newUser);
	setcookie("user",$newUser,time() + (3600), "/");
	$_SESSION['id'] = $newUser;
	return true;
}

function insertNewUser($name,$surname,$username,$email,$password,$img){
	row_insertion("users", array(trim($name),trim($surname),trim($username),trim($email),trim($password),trim($img)));
}
/*
function isAdmin(){
}
*/

?>