<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 24/01/19
 * Time: 20.23
 */

require 'databaseUtility.php';

$username = trim($_REQUEST["username"]);

echo get_information("users", "username", "username", $username);

// obtain data from request
