<?php
session_start();
require_once 'databaseUtility.php';
require_once 'productUtility.php';

$result = search_items('code','products',array('name','description'),$_REQUEST['value']);


$toBePrinted = "";
$index = 1;
foreach ($result as $item) {
    if($index %2 != 0)
        $toBePrinted .= "<div class=\"row\">";
    $toBePrinted .= get_include("../components/travel_card.php",$item);
    if($index %2 == 0)
        $toBePrinted .= "</div>";
    $index++;
}
    if($index %2 != 0)
        $toBePrinted .= "</div>";

echo $toBePrinted;

function get_include($file,$item){
    $name = getProductName($item);
    $description = getProductDescription($item);
    $price = getProductPrice($item);
    $img = getProductImg($item);
    $code = $item;
    ob_start();
    require $file;
    return ob_get_clean();
}