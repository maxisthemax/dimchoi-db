<?php
//======================================================================
// include db connection
include "lib/db.php";
include "config.php";
include "getpath.php";
include "setvariable.php";
header('Access-Control-Allow-Origin: *');
//======================================================================
$func =  $_POST['func']; //get func from post
$getfunc = (get_path($func)); //get path with func

$path = $getfunc['path']; //set path for include
$querytype = $getfunc['querytype']; //set query type search or insert/update
$_SESSION['file']='http://103.233.1.196/dimchoi/file/res/';
include $path;

unset($_POST['func']);

$output = ($func()); //execute func and get result
if (!empty($output) and $querytype == 'search')
{
	if ($func == 'getorderqrcode')
		{
		print_r($output[0]['va_qr_data_1'].','.$output[0]['va_qr_data_2']);	
		}
	else
		{
			$result = array (
				'status' => '1',
				'message' => 'success',
				'data' => $output
			);
		$fp = fopen('result.php', 'w');
    if (count($output) == 1)
    {

		fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES|JSON_FORCE_OBJECT));
		print_r(json_encode ($result, JSON_UNESCAPED_SLASHES|JSON_FORCE_OBJECT));
	}
	else	
	{
		fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES));
		print_r(json_encode ($result, JSON_UNESCAPED_SLASHES));		
	}	
		}	
}
else if ($output == true and $querytype == 'insert')
{
	$result = array (
		'status' => '0',
		'message' => 'success',
		'data' => $output
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));
}	
else if ($output == true and $querytype == 'update')
{
	$result = array (
		'status' => '0',
		'message' => 'success'
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));	
}
else if ($output == true and $querytype == 'delete')
{
	$result = array (
		'status' => '0',
		'message' => 'success'
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));
}			
else
{
	$result = array (
		'status' => '0',
		'message' => 'fail'
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));	
}
$dbhandler0->close();
//======================================================================
?>