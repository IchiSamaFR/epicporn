<?php


function GetThisUrl(){
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}



//          -------------------- SQL --------------------

function SendSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        return $dbh;
    } else {
        return $dbh -> error;
    }
}

function GetSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        $lines = mysqli_fetch_row($result);

        return $lines;
    } else {
        return $dbh -> error;
    }
}

function GetSQLRequest_NoFetchArray($request){
    $dbh = BddConnect();

    if($result = mysqli_query($dbh, $request))
    {
        return $result;
    } else {
        return $dbh -> error;
    }
}

//  Fonction clean des texts afin d'eviter les injections sql etc...
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