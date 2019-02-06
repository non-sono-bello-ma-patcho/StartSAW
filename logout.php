<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 04/02/19
 * Time: 23.44
 */
session_start();
$pages = include '../config.php';

session_destroy();
if (isset($_SESSION['id'])) unset($_SESSION['id']);
header("Location: ".$pages['index']);