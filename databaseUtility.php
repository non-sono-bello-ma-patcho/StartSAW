<?php

/*session_start();*/
/*  for debug use only */
define('DEBUG', 'debug'); //comment the line before the commercial use!!

function database_connection(){
    $dbcon = include('dbconfig.php');
    $con = mysqli_connect($dbcon['host'], $dbcon['username'], $dbcon['password'], $dbcon['dbname'], $dbcon['port']); /* TO BE CHANGED ! (USE PSW AND USER OF RIBAUDO'S DATABASE) */
    if (mysqli_connect_errno($con)){
        if(defined('DEBUG') || ($_SESSION['admin'] == true))
            $_SESSION['last_error'] =  "ERROR 500: Failed to connect to MySQL: ".mysqli_connect_error($con);
        else  $_SESSION['last_error'] = "ERROR 500: Something went wrong,please retry later or send us a message";
        header("Location: error.php");
        exit;
    }
    else return $con;
}
//

function get_information($table, $column, $columnKey, $key, $entireRow=false){
	$con = database_connection();
	$query = "SELECT ".$column." FROM ".$table." WHERE ".$columnKey." = \"".$key."\";";
	$res = mysqli_query($con,$query);
	if(!$res){
		if(defined('DEBUG') || ($_SESSION['admin'] == true))
			$_SESSION['last_error'] = "ERROR 501: Failed to execute the query: ".$query.PHP_EOL;
		else $_SESSION['last_error'] = "ERROR 501: Something went wrong,please retry later or send us a message";
		header("Location: error.php");
		exit;
	}
	$row = mysqli_fetch_assoc($res);
	// if entireRow is set, ignores column and return entire row:
	return  $entireRow? $row : $row[$column];
}


function set_information($table, $columnKey, $key, $columnToBeSet, $newValue){
	$con = database_connection();
	$query = "UPDATE ".$table." WHERE ".$columnKey = $key." SET ".$columnToBeSet." = ".$newValue.";";
	$res = mysqli_query($con,$query);
	if(!$res){
		if(defined('DEBUG') || ($_SESSION['admin'] == true))
			$_SESSION['last_error'] = "ERROR 501: Failed to execute the query: ".$query.PHP_EOL;
		else $_SESSION['last_error'] = "ERROR 501: Something went wrong,please retry later or send us a message";
		header("Location: error.php");
		exit;
	}
}


function row_insertion($table, $toBeInsert){
	$con = database_connection();
	$query ="INSERT INTO ".$table." VALUES (";
	foreach ($toBeInsert as $value) {
		$query .= "\"".$value."\",";
	}
	$query = rtrim($query,',');
	$query .= ");";
	$res = mysqli_query($con,$query);
	if(!$res){
		if(defined('DEBUG') || ($_SESSION['admin'] == true))
			$_SESSION['last_error'] = "ERROR 501: Failed to execute the query: ".$query.PHP_EOL;
		else $_SESSION['last_error'] = "ERROR 501: Something went wrong,please retry later or send us a message";
		header("Location: error.php");
		exit;
	}
}





?>