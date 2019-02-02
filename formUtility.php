<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 24/01/19
 * Time: 20.23
 */

require 'userUtility.php';

$username = trim($_REQUEST["username"]);
$op = trim($_REQUEST["op"]);
$response = array();

switch ($op){
    case "check":
        $response["username"] = get_information("users", "username", "username", $username);
        break;
    case "get_info":
        $row = get_information("users", "*", "username", $username, true);

        foreach($row as $cname => $cvalue) {
            $response[$cname] = $cvalue;
        }
        break;

}

$myJson = json_encode($response);

echo $myJson;