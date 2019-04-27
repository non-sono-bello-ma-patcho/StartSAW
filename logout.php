<?php

session_start();
$pages = include '../config.php';

session_destroy();
if (isset($_SESSION['id'])) unset($_SESSION['id']);
header("Location: ".$pages['index']);