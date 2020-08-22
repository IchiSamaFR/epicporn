<?php


function GetThisUrl(){
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}



//          -------------------- SQL --------------------

/**
 * Send a SQL request without request of return
 *
 * @param  string $request
 * @return void
 */
function SendSQLRequest(string $request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        return $dbh;
    } else {
        return $dbh -> error;
    }
}

/**
 * GetSQLRequest first result
 *
 * @param  string $request
 * @return string
 */
function GetSQLRequest(string $request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        $lines = mysqli_fetch_row($result);

        return $lines;
    } else {
        return $dbh -> error;
    }
}

/**
 * GetSQLRequest result without fetch
 *
 * @param  string $request
 * @return mysqli_query
 */
function GetSQLRequest_NoFetchArray(string $request){
    $dbh = BddConnect();

    if($result = mysqli_query($dbh, $request))
    {
        return $result;
    } else {
        return $dbh -> error;
    }
}

/**
 * Clean Text to avoid SQL Injections
 *
 * @param  mixed $string It could be an array like a string
 * @return string Get result with slashes
 */
function CleanText($string){
    if(is_array($string)){
        foreach($string as $key => $val){
            $string[$key] = addslashes($val);
        }
        return $string;
    } else {
        $string = addslashes($string);
        return $string;
    }
}

?>