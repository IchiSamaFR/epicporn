<?php


$configConnection = array(
    //  Where is your database
    "db_host" => "localhost",

    //  Which database
    "db_name" => "epicporn",

    //  Username of connection
    "db_username" => "root",

    //  Pass of connection
    "db_pass" => "",

    //  Database charset
    "db_charset" => "utf8mb4",
);

function BddConnect(){
    $db_host = "localhost";
    $db_name = "local_epicporn";
    $db_username = "root";
	$db_pass = "";
    $dbh = mysqli_connect($db_host,$db_username,$db_pass, $db_name);
    $dbh -> set_charset("utf8mb4");
    return $dbh;
}

?>