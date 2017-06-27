<?php
//======================================================================
// include db connection
include "lib/db.php";
include "config.php";
include "getpath.php";
header('Access-Control-Allow-Origin: *');
//======================================================================
$func =  $_POST['func']; //get func from post
$getfunc = (get_path($func)); //get path with func

$path = $getfunc['path']; //set path for include
$querytype = $getfunc['querytype']; //set query type search or insert/update

include $path;

unset($_POST['func']);

$output = ($func()); //execute func and get result
if (!empty($output) and $querytype = 'search')
{
	$result = array (
		'status' => '1',
		'message' => 'success',
		'data' => $output,
	);
}
else if ($output == true and $querytype = 'insert')
{
	$result = array (
		'status' => '0',
		'message' => 'success',
	);
}	
else
{
	$result = array (
		'status' => '0',
		'message' => 'fail',
	);
}
var_dump($result);
$fp = fopen('result.php', 'w');
fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES));

$dbhandler0->close();
//======================================================================
?>