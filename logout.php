<?php

$source = include("../config.php");
session_destroy();
header("Location: ".$source['index']);
exit;