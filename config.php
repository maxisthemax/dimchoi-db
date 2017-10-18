<?php

header('Content-Type:text/html; application/json; charset=utf-8');

//Set connection time limit/memory limit to infinity/unlimited
set_time_limit(0);
ini_set('default_charset', 'UTF-8');
ini_set('memory_limit', '-1');

//set debug setting
define("DEBUG_REQUEST",0);
define("DEBUG_QUERY",0);

//set database host, username & password
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

$string = file_get_contents("settings.php");
$dbname =json_decode($string,true); 

$dbname = isset($dbname['dbname']) ? $dbname['dbname'] : 'dimchoi';

$dbhandler0 = new database($dbhost, $dbuser, $dbpass, $dbname);

date_default_timezone_set('Asia/Kuala_Lumpur');

$mustwritelevel = 0;

?>