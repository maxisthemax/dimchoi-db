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
		echo json_encode ($result, JSON_UNESCAPED_SLASHES);
}
else if ($output == true and $querytype = 'insert')
{
	$result = array (
		'status' => '0',
		'message' => 'success',
	);
		echo json_encode ($result, JSON_UNESCAPED_SLASHES);
}	
else	
{
	$result = array (
		'status' => '0',
		'message' => 'fail',
	);
		echo json_encode ($result, JSON_UNESCAPED_SLASHES);
}

$dbhandler0->close();
//======================================================================
?>