<?php

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

?>