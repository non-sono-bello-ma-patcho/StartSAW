<?php
/**
 * Created by PhpStorm.
 * User: shinon
 * Date: 26/05/19
 * Time: 16:07
 */
session_start();
require_once "userUtility.php";
require_once "mailUtility.php";

function unique_id($lenght) {
    return substr(sha1($_SESSION['id']).md5(uniqid(mt_rand(), true)), 0, $lenght);
}

$key = unique_id(42);
date_default_timezone_set('Europe/Rome');
insertNewSafeKey($_SESSION['id'],$key,date('Y-m-d'),date('H:i:s',time()));
send_mail(2,getUserMail($_SESSION['id']),$key);
header("Location: ../private.php");