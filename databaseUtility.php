<?php


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////AUXILIARY METHODS/////////////////////////////////////////////////////////



function database_connection(){
    $dbcon = include('dbconfig.php');
    $con = mysqli_connect($dbcon['host'], $dbcon['username'], $dbcon['password'], $dbcon['dbname'], $dbcon['port']);
    if (mysqli_connect_errno()){ /* attenzione ho tolto il parametro $con */
        http_response_code(500);
        $_SESSION['last_error'] =  "Failed to connect to MySQL: ".mysqli_connect_error($con);
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }
    else return $con;
}

function send_query($con,$query){
    $res = mysqli_query($con,$query);
    if(!$res){
        http_response_code(500);
        $_SESSION['last_error'] = "Failed to execute the query: ".$query.PHP_EOL;
        header("Location: ../error.php?code=".http_response_code());
        exit;
    }
    else return $res;
}


function generate_condition($column , $key){
    $condition = "";
    $index = 0;
    if(is_array($column) && is_array($key)){
        foreach($column as $singleColumn) {
            $condition .= $singleColumn . " = \"" . $key[$index] . "\" AND ";
            $index++;
        }
        $condition = substr($condition,0,-4);
    }
    else $condition = $column." = \"".$key."\"";
    return $condition;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////CORE METHODS///////////////////////////////////////////////////////////




function get_information($table, $column, $columnKey, $key, $entireRow=false){
	$con = database_connection();
	$condition = generate_condition($columnKey,$key);
	$query = "SELECT ".$column." FROM ".$table." WHERE ".$condition.";";
    $res = send_query($con,$query);
	$row = mysqli_fetch_assoc($res);
	mysqli_close($con);
	// if entireRow is set, ignores column and return entire row:
	return  $entireRow? $row : $row[$column];
}

function get_information_listed($table, $column, $columnKey, $key, $like=false){
    $con = database_connection();
    $cond = $like? $columnKey." = like\"%".$key.";" : generate_condition($columnKey,$key);
    //$cond = $like? " like \"%".$key."%\";" : " = \"".$key."\";";
    $query = "SELECT ".$column." FROM ".$table." WHERE ".$cond;
    $res = send_query($con,$query);
    $array = array();
    $index = 0;
    while( $row = mysqli_fetch_assoc($res)){
        foreach($row as $key => $value) {
            $array[$index] = $column = "*" ? $row[$key] : $row[$column];
            $index++;
        }
    }
    mysqli_close($con);
    return  $array;
}


function get_multiple_information($table,$column,$columnKey=false,$key=false){
    if(!is_array($column)) return;
    $con = database_connection();
    $query = "SELECT ";
    foreach($column as $item){
        $query .= $item.",";
    }
    $query = substr($query,0,-1);
    if($columnKey && $key) {
        $condition = generate_condition($columnKey,$key);
        $query .= " FROM " . $table . " WHERE " . $condition;
    }
    else $query .=" FROM ".$table;
    $res = send_query($con,$query);
    $array = array();
    while( $row = mysqli_fetch_assoc($res)){
        array_push($array,$row);
    }
    mysqli_close($con);
    return $array;
}

function get_Entire_Column($table,$column){
    $con = database_connection();
    $query = "SELECT $column FROM ".$table;
    $res = send_query($con,$query);
    $array = array();
    $index = 0;
    while( $row = mysqli_fetch_assoc($res)){
        $array[$index] = $row[$column];
        $index++;
    }
    mysqli_close($con);
    return  $array;
}

function get_All($table){
    $con = database_connection();
    $query = "SELECT * FROM ".$table;
    $res = send_query($con,$query);
    $array = array();
    while( $row = mysqli_fetch_assoc($res)){
        array_push($array,$row);
    }
    mysqli_close($con);
    return  $array;
}

function set_information($table, $columnKey, $key, $columnToBeSet, $newValue, $numeric=false){
	$con = database_connection();
    $condition = generate_condition($columnKey,$key);
    $toupdate = $numeric? $newValue : "\"".$newValue."\"";
    $query = "UPDATE ".$table." SET ".$columnToBeSet." = ".$toupdate." WHERE ".$condition.";";
	send_query($con,$query);
	mysqli_close($con);
}


function row_insertion($table, $toBeInsert){
	$con = database_connection();
	$query ="INSERT INTO ".$table." VALUES (";
	foreach ($toBeInsert as $value) {
	    if($value instanceof Integer) //TODO VERIFICARE LA CORRETTEZZA CON IN NUMERI INTERI
	        $query .= $value.",";
		else $query .= "\"".$value."\",";
	}
	$query = rtrim($query,',');
	$query .= ");";
    send_query($con,$query);
    mysqli_close($con);
}

function row_deletion($table,$columnKey,$toBeDeleted){
    $con = database_connection();
    $condition = generate_condition($columnKey,$toBeDeleted);
    $query = "DELETE FROM ".$table." WHERE ".$condition.";";
    send_query($con,$query);
    mysqli_close($con);
}

function filters_handler($filters,$orderby=false,$direction=false){
    $condition ="";
    foreach($filters as $filterName => $value){
        switch($filterName){
            case "maxPrice": $condition .= "price <= $value AND "; break;
            case "minPrice": $condition .= "price >= $value AND "; break;
            case "guide": $condition .= "guide = $value AND "; break;
            case "housing": $condition .= "housing = $value AND "; break;
            case "minAge": $condition .= "minAge >= $value AND "; break;
            case "maxDistance": $condition .=  "distance <= $value AND "; break;
            case "minDistance": $condition .= "distance >= $value AND "; break;
            case "maxUsers": $condition .= "maxUsers <= $value AND "; break;
        }
    }
    $condition = substr($condition,0,-4);
    $condition .= $orderby && $direction ? "ORDER BY $orderby $direction" : "";
    return $condition;
}


function search_items($resultColumn,$table,$columnMatch,$search,$orderby,$direction,$filters=false){
    $con = database_connection();
    $query = "SELECT ".$resultColumn." FROM ".$table." WHERE MATCH(";
    foreach ($columnMatch as $column)
        $query .= $column.",";
    $query = substr($query,0,-1);
    $query .= ") AGAINST('+".$search."' IN NATURAL LANGUAGE MODE)";
    if($filters !== false)
        $condition = $orderby !== false && $direction !== false  ? filters_handler($filters,$orderby,$direction)
            : filters_handler($filters);
    else $condition = $orderby !== false && $direction !== false ? "ORDER BY $orderby $direction" : "";
    $query .= " $condition ;";

    error_log("executing query: {$query}");

    $res = send_query($con,$query);
    $array = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($array, $row);
    }
    mysqli_close($con);
    return  $array;

}
