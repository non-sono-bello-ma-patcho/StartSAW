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
    case "searchuser":
        $tmp = get_information_listed("users", "username", "username", $username, true);
        foreach ($tmp as $user){
            $response.array_push($response, get_information("users", "name, surname, username, email, admin, img", "username", $user, true));
        }
        break;
}

$myJson = json_encode($response);

echo $myJson;