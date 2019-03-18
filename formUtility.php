<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 24/01/19
 * Time: 20.23
 */

require 'userUtility.php';

$param = trim($_REQUEST["param"]);
$op = trim($_REQUEST["op"]);
$response = array();

switch ($op){
    case "check":
        $response["username"] = get_information("users", "username", "username", $param);
        break;
    case "get_info":
        $row = get_information("users", "*", "username", $param, true);

        foreach($row as $cname => $cvalue) {
            $response[$cname] = $cvalue;
        }
        break;
    case "searchuser":
        $tmp = get_information_listed("users", "username", "username", $param, true);
        foreach ($tmp as $user){
            $response.array_push($response, get_information("users", "name, surname, username, email, admin, img", "username", $user, true));
        }
        break;
    case "searchproduct":
        $row = get_information("products", "*", "code", $param, true);
        foreach($row as $cname => $cvalue) {
            $response[$cname] = $cvalue;
        }
        break;
}

$myJson = json_encode($response);

echo $myJson;