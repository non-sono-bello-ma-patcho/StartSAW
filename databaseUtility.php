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



function generate_condition($column , $key, &$params,&$types){
    $condition = "";
    $index = empty($params)?  0 : 1;
    $keyIndex = 0;
    if(is_array($column) && is_array($key)){
        foreach($column as $singleColumn) {
            $condition .=  "$singleColumn = ? AND ";
            $params[$index] = $key[$keyIndex];
            $types.= is_numeric($key[$keyIndex])? "i" : "s";
            $index++;
            $keyIndex++;
        }
        $condition = substr($condition,0,-4);
    }
    else{
        $condition =  "$column = ? ";
        $params[$index] = $key;
        $types.= is_numeric($key[$keyIndex])? "i" : "s";
    }
    return $condition;
}


function error_report($text){
    $_SESSION['last_error']= "Failed to execute the query: $text".PHP_EOL;
    header("Location: ../error.php?code=500");
    exit;
}

function send_query($con,$text,$types = false,$params = false,$queryType = "select"){
    if($stmt = $con->prepare($text)){
        if($types && $params)
            $stmt->bind_param($types,...$params);
        $stmt->execute();
        $stmt_result= $stmt->get_result();
        //if($stmt_result === false)
           // if($queryType ==="select") error_report($text); //TODO FORSE DA MODIFICARE, QUERY VUOTA OK

        $stmt->close();
        return $stmt_result;
    }
    else error_report($text);

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////CORE METHODS///////////////////////////////////////////////////////////




function get_information($table, $column, $columnKey, $key, $entireRow=false){

    $con = database_connection();
    //$params = array();
    $types="";
    $condition = generate_condition($columnKey,$key,$params,$types);
    $text = "SELECT $column FROM $table WHERE $condition ";
    $stmt_result = send_query($con,$text,$types,$params);
    $row = $stmt_result->fetch_assoc();
    return $entireRow? $row : $row[$column];
}

function get_information_listed($table, $column, $columnKey, $key, $like=false){
    $con = database_connection();
    $params = $types="";
    $condition = $like? $columnKey." = like\"% ? ;" : generate_condition($columnKey,$key,$params,$types);
    $text = "SELECT $column FROM $table WHERE $condition";
    $stmt_result = send_query($con,$text,$types, $params);
    $my_results = [];
    while($row = $stmt_result->fetch_assoc()){
        array_push($my_results,$row);
    }
    return $my_results;
}


function get_multiple_information($table,$column,$columnKey=false,$key=false){
    if(!is_array($column)) return;
    $con = database_connection();
    $types="";
    $text = "SELECT ";
    $my_results = [];
    foreach($column as $item){
        $text .= $item.",";
    }
    $text = substr($text,0,-1);
    if($columnKey && $key) {
        $condition = generate_condition($columnKey,$key,$params,$types);
        $text .= " FROM $table WHERE $condition";
        $stmt_result = send_query($con,$text,$types,$params);
    }
    else {
        $text .= " FROM $table";
        if(!$stmt = $con->prepare($text)) error_report($text);
        $stmt->execute();
        $stmt_result= $stmt->get_result();
        if(!$stmt_result) error_report($text);
        $stmt->close();
    }
    while($row = $stmt_result->fetch_assoc()){
        array_push($my_results,$row);
    }
    return $my_results;
}

function get_Entire_Column($table,$column){
    $con = database_connection();
    $types="";
    $text = "SELECT $column FROM $table";
    if(! $stmt = $con->prepare($text)) error_report($text);
    $stmt->execute();
    $my_results = [];
    if(! $stmt_result = $stmt->get_result()) error_report($text);
    while($row = $stmt_result->fetch_assoc()){
        array_push($my_results,$row);
    }
    return $my_results;
}

function get_All($table, $condition,$params = false){
    $con = database_connection();
    $types="";
    $text = "SELECT * FROM $table WHERE $condition";
    $stmt_result = send_query($con,$text,$types,$params);
    $my_results = [];
    while($row = $stmt_result->fetch_assoc()){
        array_push($my_results,$row);
    }
    return $my_results;
}

function set_information($table, $columnKey, $key, $columnToBeSet, $newValue, $numeric=false){
	$con = database_connection();
    $types = $numeric? "i" : "s";
    $params[0] = $newValue;
    $condition =  generate_condition($columnKey,$key,$params,$types);
	$text = "UPDATE $table SET  $columnToBeSet = ? WHERE $condition";
	send_query($con,$text,$types,$params,"update");
}


function row_insertion($table, $toBeInsert){
	$con = database_connection();
	$text =" INSERT INTO $table VALUES (";
	$types="";
	$index = 0;
	$params= array();
    foreach ($toBeInsert as $value){
        if(is_numeric($value))
            $types .="i";
        else $types .= "s";
        $params [$index] = $value;
        $text .= "?,";
        $index++;
    }
    $text = rtrim($text,',');
    $text .= ")";
    send_query($con,$text,$types,$params,"insert");
}

function row_deletion($table,$columnKey,$toBeDeleted){
    $con = database_connection();
    $condition = generate_condition($columnKey,$toBeDeleted,$params,$types);
    $text = "DELETE FROM $table WHERE $condition";
    send_query($con,$text,$types,$params,"delete");
}


function getLastSafeKey($username,$date){
    $con = database_connection();
    $query = "SELECT secretcode FROM safenessKey WHERE username= ? AND dateOfRequest =  ? AND 
                timeOfRequest IN ( SELECT max(timeOfRequest) FROM safenessKey WHERE dateOfRequest= ?);";
    $res = send_query($con,$query,"sss",array($username,$date,$date));
    $row = $res->fetch_assoc();
    return $row['secretcode'];
}



function filters_handler($filters,&$types,&$params,$orderby=false,$direction=false){
    $condition ="";
    $index = 1;
    if(!empty($filters)) {
        foreach ($filters as $filterName => $value) {
            switch ($filterName) {
                    case "maxPrice":
                        $condition .= "AND price <= ? ";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "minPrice":
                        $condition .= "AND price >= ? ";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "guide":
                        $condition .= "AND guide = ? ";
                        $types.= "i";
                        $params[$index] = intval($value);
                        break;
                    case "housing":
                        $condition .= "AND housing = ? ";
                        $types.= "i";
                        $params[$index] = intval($value);
                        break;
                    case "minAge":
                        $condition .= "AND minAge >= ? ";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "maxDistance":
                        $condition .= "AND distance <= ? ";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "minDistance":
                        $condition .= "AND distance >= ? ";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "maxUsers":
                        $condition .= "AND maxUsers <= ? ";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "level":
                        $condition .= "AND level = ?";
                        $types.= "i";
                        $params[$index] = $value;
                        break;
                    case "destination": $index--;
                        break;
                }
                $index++;
            }
        }
    $condition .= $orderby && $direction ? "ORDER BY $orderby $direction" : "";
    return $condition;
}


function search_items($resultColumn,$table,$columnMatch,$search,$orderby,$direction,$filters=false){
    $con = database_connection();
    $params = [];
    $text = "SELECT $resultColumn FROM $table WHERE active = ? AND MATCH(";
    $params[0]= intval(true);
    $types="i";
    $text .= array_pop($columnMatch);
    foreach ($columnMatch as $column)
        $text .= ", $column";
    $text .= ") AGAINST('+$search' IN NATURAL LANGUAGE MODE)";
    if($filters !== false)
        $condition = $orderby !== false && $direction !== false  ? filters_handler($filters,$types,$params,$orderby,$direction)
            : filters_handler($filters,$types,$params);
    else $condition = $orderby !== false && $direction !== false ? "ORDER BY $orderby $direction" : "";
    $text .= " $condition ";
    $stmt_res = send_query($con,$text,$types,$params);
    $my_results = [];
    while($row = $stmt_res->fetch_assoc()){
        array_push($my_results, $row);
    }
    return $my_results;
}
