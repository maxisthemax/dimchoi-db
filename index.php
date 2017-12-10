<?php
//======================================================================
// include db connection
include "lib/db.php";
include "config.php";
include "getpath.php";
require 'PHPMailer/PHPMailerAutoload.php';
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
if (!empty($output) and $querytype == 'search' and $output > 0 )
{
			$result = array (
				'status' => '1',
				'message' => 'success',
				'data' => $output
			);
		print_r(json_encode ($result, JSON_UNESCAPED_SLASHES));			
}
else if ($output == true and $querytype == 'insert' and $output > 0)
{
	$result = array (
		'status' => '1',
		'message' => 'success',
		'data' => $output
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));
}	
else if ($output == true and $querytype == 'update')
{
	$result = array (
		'status' => '1',
		'message' => 'success'
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));	
}
else if ($output == true and $querytype == 'delete')
{
	$result = array (
		'status' => '1',
		'message' => 'success'
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));
}			
else
{
	if ($output == -1)
	{
		$message = 'Incorrect Password';
	}	
	else if ($output == -2)
	{
		$message = 'Email Not Found';
	}
	else if ($output == -3)
	{
		$message = 'Email Already Exist, Please Login';
	}
	else if ($output == -4)
	{
		$message = 'Restaurant Username Not Found, Please Contact DimChoi Admin';
	}				
	else
	{
		$message = 'Fail';
	}	
	$result = array (
		'status' => '0',
		'message' => $message
	);
	echo(json_encode ($result, JSON_UNESCAPED_SLASHES));	
}
$dbhandler0->close();

?>