<?php

$runfunction = !empty($_POST['runfunction']) ? $_POST['runfunction'] : '';
if ($runfunction == 'generatefirebase')
{
$userid = !empty($_POST['userid']) ? $_POST['userid'] : 0;
$resuserid = !empty($_POST['resuserid']) ? $_POST['resuserid'] : 0;
$token = !empty($_POST['token']) ? $_POST['token'] : '';
$title = !empty($_POST['title']) ? $_POST['title'] : '';
$body = !empty($_POST['body']) ? $_POST['body'] : '';
$broadcast = !empty($_POST['broadcast']) ? $_POST['broadcast'] : '';
$mode = !empty($_POST['mode']) ? $_POST['mode'] : 0;    

generatefirebase($title,$body,$broadcast,$userid,$resuserid,$token,$mode);
}

function WriteDebugLog($Name, $MustWrite = 0, $MainInfo = "") {

    global $mustwritelevel;

	$actualwritelevel = $MustWrite;
    if ($MainInfo != "") {
        $MustWrite = $mustwritelevel;
    }

    if ($MustWrite >= $mustwritelevel) {

        if ($actualwritelevel == 4) {
            $fileAdd = 'log/dimchoi' . date("Ymd") . '_DEBUG_SERVICES.log';
            @$fp = fopen($fileAdd, "ab");
            if (!$fp) {
                echo "Can't create the file: $fileAdd";
                return false;
            } else {
                flock($fp, LOCK_EX); //Lock the file for writing	
            }
            
        } 
        else if ($actualwritelevel == 5) {
            $fileAdd = 'log/dimchoi' . date("Ymd") . '_SMS_SERVICES.log';
            @$fp = fopen($fileAdd, "ab");
            if (!$fp) {
                echo "Can't create the file: $fileAdd";
                return false;
            } else {
                flock($fp, LOCK_EX); //Lock the file for writing	
            }
        }
        else if ($actualwritelevel == 6) {
        	$fileAdd = 'log/dimchoi' . date("Ymd") . '_DRS_SERVICES.log';
        	@$fp = fopen($fileAdd, "ab");
        	if (!$fp) {
        		echo "Can't create the file: $fileAdd";
        		return false;
        	} else {
        		flock($fp, LOCK_EX); //Lock the file for writing
        	}
        }
        else {
            $fileAdd = 'log/dimchoi' . date("Ymd") . '_DEBUG.log';

            @$fp = fopen($fileAdd, "ab");
            if (!$fp) {
                echo "Can't create the file: $fileAdd";
                return false;
            } else {
                flock($fp, LOCK_EX); //Lock the file for writing	
            }
        }

        $outputstring = date("H:i:s") . " $Name";
        $outputstring = $outputstring . "\r\n";


        fwrite($fp, $outputstring);


        flock($fp, LOCK_UN);


        fclose($fp);
        if (filesize($fileAdd) <= 3000) {
            chmod($fileAdd, 0755);
        }
    }
}

function encrypted($key, $string) {
    $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),MCRYPT_DEV_URANDOM 
    );

    $encrypted = base64_encode(
            $iv .
            mcrypt_encrypt(
                    MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), $string, MCRYPT_MODE_CBC, $iv
            )
    );

    if (!empty($encrypted)) {
        return $encrypted;
    }
     return $string;
}

function decrypted($key, $string) {
    $data = base64_decode($string);
    $iv_dec = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

    $decrypted = rtrim(
            mcrypt_decrypt(
                    MCRYPT_RIJNDAEL_128, hash('sha256', $key, true), substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)), MCRYPT_MODE_CBC, $iv_dec
            )
    );

    if (!empty($decrypted)) {
        return $decrypted;
    }
    return $string;   
}

function generatefirebase($title,$body,$broadcast,$userid,$resuserid,$token,$mode) //1-send message, 2-send broadcast to phone
{

global $dbhandler0;
$url = $_SERVER['SERVER_NAME'].'/dimchoi/firebase.php';

if ($token != '')
{
    if ($userid > 0)
    {     
        $sqluser = "SELECT va_token FROM user where i_user_id = $userid LIMIT 1";
        $resuser = $dbhandler0->query($sqluser);
        $token = $resuser[0]['va_token'];
    }
    else if ($resuserid > 0)
    {
        $sqlresuser = "SELECT va_token FROM resuser where i_res_user_id = $userid LIMIT 1";
        $resresuser = $dbhandler0->query($sqlresuser);   
        $token = $resresuser[0]['va_token'];
    }
}

if ($mode == 1)
{
$sendpost = array
        (
            'title' => $title,
            'body'  => $body,
            'token' => $token,
            'mode' => $mode
        );
}
else if ($mode == 2)
{
$sendpost = array
        (
            'broadcast'  => $broadcast,
            'token' => $token,
            'mode' => $mode
        );
}

$ch = curl_init($url);
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $sendpost);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );  
echo $response;
}

?>