<?php

function GetConfig(){
    
    $configConnection = array(
        //  Where is your database
        'db_host' => 'localhost',

        //  Which database
        'db_name' => 'local_epicporn',

        //  Username of connection
        'db_username' => 'root',

        //  Pass of connection
        'db_pass' => '',

        //  Database charset
        'db_charset' => 'utf8mb4'
    );
    return $configConnection;
}

function BddConnect(){
    $config = GetConfig();
    
    $db_host = $config['db_host'];
    $db_name = $config['db_name'];
    $db_username = $config['db_username'];
	$db_pass = $config['db_pass'];
    $dbh = mysqli_connect($db_host,$db_username,$db_pass, $db_name);
    $dbh -> set_charset($config['db_charset']);
    return $dbh;
}

?>