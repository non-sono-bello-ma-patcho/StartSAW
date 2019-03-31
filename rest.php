<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 24/01/19
 * Time: 20.23
 */

require_once 'userUtility.php';

$param = isset($_REQUEST["param"])? trim($_REQUEST["param"]) : "";
$op = trim($_REQUEST["op"]); // must be set always
$username = isset($_REQUEST["username"])? trim($_REQUEST["username"]) : "";
$id = isset($_REQUEST['id'])? $_REQUEST['id'] : "";
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
    case "addToCart":
        $response = is_array($param)? "got an array" : "got single variable...";

        break;
    case "searchproduct":
        $row = get_information("products", "*", "code", $param, true);
        foreach($row as $cname => $cvalue) {
            $response[$cname] = $cvalue;
        }
        break;
    case "latest_prod":
        $tmp = get_information_listed($param, "code", "code", '%%', true);
        foreach ($tmp as $product){
            $response.array_push($response, $product);
        }
        break;
}

$myJson = json_encode($response);

echo $myJson;