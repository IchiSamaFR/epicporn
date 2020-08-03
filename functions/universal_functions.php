<?php
//          -------------------- SQL --------------------

function SendSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        return true;
    } else {
        return "Error";
    }
}

function GetSQLRequest($request){
    $dbh = BddConnect();
    if($result = mysqli_query($dbh, $request)){
        $lines = mysqli_fetch_row($result);

        return $lines;
    } else {
        return "Error";
    }
}

function GetSQLRequest_NoFetchArray($request){
    $dbh = BddConnect();

    if($result = mysqli_query($dbh, $request))
    {
        return $result;
    } else {
        return "Error";
    }
}

//  Fonction clean des texts afin d'eviter les injections sql etc...
function CleanText($string){
    $string = addslashes($string);
    return $string;
}

?>