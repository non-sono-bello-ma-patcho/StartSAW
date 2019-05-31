<?php
/**
 * Created by PhpStorm.
 * User: shinon
 * Date: 31/05/19
 * Time: 15:10
 */

session_start();
require_once "productUtility.php";

if(isset($_POST['editproductform'])){
    if(!existingProduct($_POST['ecode'])) {
        http_response_code(500);
        $_SESSION['last_error'] = "the product code is incorrect and the first check missed the error";
        header("Location: ../error.php?code=" . http_response_code());
        exit;
    }

    removeProduct($_POST['ecode']);
    header("Location: ".$source['private']);
    exit;

}
else{
    http_response_code(503);
    $_SESSION['last_error'] = "editproductform is not set";
    header("Location: ../error.php?code=".http_response_code());
    exit;
}