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
//    $cond = $like? $columnKey." = like\"%".$key.";" : generate_condition($columnKey,key);
    $cond = $like? " like \"%".$key."%\";" : " = \"".$key."\";";
    $query = "SELECT ".$column." FROM ".$table." WHERE ".$columnKey.$cond;
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

function get_All($table, $condition){
    $con = database_connection();
    $query = "SELECT * FROM $table WHERE $condition";
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
    error_log("executing query: {$query}");
    send_query($con,$query);
    mysqli_close($con);
}


function getLastSafeKey($username,$date){
    $con = database_connection();
    $query = "SELECT secretcode FROM safenessKey WHERE username= '$username' AND dateOfRequest = '$date' AND 
                timeOfRequest IN ( SELECT max(timeOfRequest) FROM safenessKey WHERE dateOfRequest= '$date');";
    $res = send_query($con,$query);
    $row = mysqli_fetch_assoc($res);
    mysqli_close($con);
    return $row['secretcode'];
}



function filters_handler($filters,$orderby=false,$direction=false){
    $condition ="";
    if(!empty($filters)) {

        foreach ($filters as $filterName => $value) {
           /* if($value !== "planet") {
                $_SESSION['last_error'] = "sono nel for, $filterName = $value ";
                header("Location: ../error.php?code=500");
                exit;
            }*/


            switch ($filterName) {
                case "maxPrice":
                    $condition .= "AND price <= $value ";
                    break;
                case "minPrice":
                    $condition .= "AND price >= $value ";
                    break;
                case "guide":
                    $condition .= "AND guide = $value ";
                    break;
                case "housing":
                    $condition .= "AND housing = $value ";
                    break;
                case "minAge":
                    $condition .= "AND minAge >= $value ";
                    break;
                case "maxDistance":
                    $condition .= "AND distance <= $value ";
                    break;
                case "minDistance":
                    $condition .= "AND distance >= $value ";
                    break;
                case "maxUsers":
                    $condition .= "AND maxUsers <= $value ";
                    break;
                case "level":
                    $condition .= "AND level = $value";
                    break;
            }
        }
    }
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
    // controlla prima che ci siano i filtri
    if($filters != false){
        // aggiungi i filtri alla ricerca
        $condition = filters_handler($filters);
    }

    if($filters !== false)
        $condition = $orderby !== false && $direction !== false  ? filters_handler($filters,$orderby,$direction)
            : filters_handler($filters);
    else $condition = $orderby !== false && $direction !== false ? "ORDER BY $orderby $direction" : "";
    $query .= " $condition ;";


    $res = send_query($con,$query);
    $array = array();
    while($row = mysqli_fetch_assoc($res)){
        array_push($array, $row);
    }
    mysqli_close($con);
    return  $array;

}
