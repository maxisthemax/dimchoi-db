<?php
//======================================================================
// include db connection
include "lib/db.php";
include "config.php";
include "getpath.php";
include "setvariable.php";
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

		fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES));
		print_r(json_encode ($result, JSON_UNESCAPED_SLASHES));		
		}	
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
//======================================================================

/*$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'mail.maxisthemax.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'test@maxisthemax.com';          // SMTP username
$mail->Password = '123qweasdzxc'; // SMTP password
$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                 // TCP port to connect to

$mail->setFrom('test@maxisthemax.com', 'Max Leong');
$mail->addAddress('maxisthemax89@gmail.com', 'Max Leong');   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Sending Email From LocalHost</h1>';
$bodyContent .= '<p>Finaly Now I can send mail <b>offline</b></p>';

$mail->Subject = 'Email from Localhost By Mohsin Shoukat';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
	// visit our site www.studyofcs.com for more learning
}
*/
?>