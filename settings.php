<?php
include "system/function.php";
include "lib/db.php";
include "config.php";
include "getpath.php";
global $dbhandler0;
    $dev = isset($_POST['dev']) ? $_POST['dev'] : '';
    if (!empty($dev) or $dev != 0)
    {   
        $sqlcheck = "UPDATE settings SET va_value = '$dev' WHERE va_name = 'dev'";
        $res = $dbhandler0->update($sqlcheck);
    }
    //===============================================
    $sqlcheck = "SELECT va_value
    FROM settings 
    where va_name = 'dev'";
    //===============================================
    $res = $dbhandler0->query($sqlcheck);
    echo($res[0]['va_value']);
?>